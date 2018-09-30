USE hydroponics;

INSERT INTO Greenhouse(id, name, created_at) VALUES(1, 'My Greenhouse', NOW());

INSERT INTO System(id, greenhouse_id, name, created_at) VALUES(1, 1, 'System NFT 1', NOW());
INSERT INTO System(id, greenhouse_id, name, created_at) VALUES(2, 1, 'System NFT 2', NOW());
INSERT INTO System(id, greenhouse_id, name, created_at) VALUES(3, 1, 'System NFT 2', NOW());