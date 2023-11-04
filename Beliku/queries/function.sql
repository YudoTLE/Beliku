CREATE OR REPLACE PROCEDURE edit_list(
    list_id         INT,
    new_name        VARCHAR(63),
    new_description VARCHAR(1023),
    new_price       INT,
    new_stock       INT
)
LANGUAGE plpgsql AS $$
DECLARE
    new_item_id INT;
BEGIN
    INSERT INTO Item VALUES(DEFAULT, new_name, new_description, new_price) RETURNING id INTO new_item_id;

    UPDATE List SET item_id = new_item_id, stock = new_stock WHERE id = list_id;
END; $$;

CREATE OR REPLACE FUNCTION buy(
    buyer_username  VARCHAR(63),
    list_id         INT,
    amount          INT
)
RETURNS TEXT
LANGUAGE plpgsql AS $$
DECLARE
    item_id         INT;
    item_price      INT;
    seller_username VARCHAR(63);
BEGIN
    SELECT i.id INTO item_id FROM List l JOIN Item i ON i.id = l.item_id WHERE l.id = list_id;
    SELECT price INTO item_price FROM Item WHERE id = item_id;
    SELECT owner_username INTO seller_username FROM List WHERE id = list_id;

    IF EXISTS(SELECT 1 FROM Account WHERE username = buyer_username AND balance < item_price * amount) THEN
        RETURN 'failed';
    END IF;

    UPDATE Account SET balance = balance - item_price * amount WHERE username = buyer_username;
    UPDATE Account SET balance = balance + item_price * amount WHERE username = seller_username;

    UPDATE List SET stock = stock - amount WHERE id = list_id;
    
    INSERT INTO Transaction VALUES(DEFAULT, buyer_username, seller_username, item_id, amount, NOW());

    RETURN 'success';
END; $$;