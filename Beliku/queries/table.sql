CREATE OR REPLACE TABLE Account(
    username    VARCHAR(63),
    password    VARCHAR(63),
    name        VARCHAR(63),
    balance     INT,

    PRIMARY KEY(username)
);

CREATE OR REPLACE TABLE Item(
    id          SERIAL,
    name        VARCHAR(63),
    description VARCHAR(1023),
    price       INT,

    PRIMARY KEY(id)
);

CREATE OR REPLACE TABLE List(
    id              SERIAL,
    owner_username  VARCHAR(63),
    item_id         INT,
    stock           INT,

    PRIMARY KEY(id),
    FOREIGN KEY(owner_username) REFERENCES Account(username),
    FOREIGN KEY(Item_id)        REFERENCES Item(id)
);

CREATE OR REPLACE TABLE Transaction(
    id              SERIAL,
    buyer_username  VARCHAR(63),
    seller_username VARCHAR(63),
    item_id         INT,
    amount          INT,
    date            DATE,

    PRIMARY KEY(id),
    FOREIGN KEY(buyer_username)     REFERENCES Account(username),
    FOREIGN KEY(seller_username)    REFERENCES Account(username),
    FOREIGN KEY(item_id)            REFERENCES Item(id)
);