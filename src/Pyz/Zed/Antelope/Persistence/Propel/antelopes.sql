INSERT INTO pyz_antelope_type ( type_name)
VALUES
    ( 'Savannah Antelope'),
    ( 'Forest Antelope'),
    ( 'Desert Antelope'),
    ('Mountain Antelope'),
    ('Water Antelope');
INSERT INTO pyz_antelope_location ( location_name, latitude, longitude)
VALUES
    ( 'Kenya', -1.286389, 36.817223),
    ( 'South Africa', -30.559482, 22.937506),
    ('Namibia', -22.95764, 18.49041),
    ( 'Tanzania', -6.369028, 34.888822),
    ('Botswana', -22.328474, 24.684866);

INSERT INTO pyz_antelope (name, color, type_id, location_id, gender, weight)
VALUES
    ('Antelope Alpha', 'Brown', 1, 1, 1, 150.5),
    ('Antelope Bravo', 'Gray', 2, 2, 2, 120.3),
    ('Antelope Charlie', 'Golden', 3, 3, 1, 180.7),
    ('Antelope Delta', 'Black', 4, 4, 1, 210.0),
    ('Antelope Echo', 'White', 5, 5, 2, 140.2),
    ('Antelope Foxtrot', 'Tan', 1, 2, 2, 130.8),
    ('Antelope Golf', 'Beige', 2, 3, 1, 175.4),
    ('Antelope Hotel', 'Dark Brown', 3, 4, 2, 165.5),
    ('Antelope India', 'Light Brown', 4, 5, 1, 200.0),
    ('Antelope Juliet', 'Reddish', 5, 1, 2, 145.6),
    ('Antelope Kilo', 'Yellow', 1, 3, 1, 155.0),
    ('Antelope Lima', 'Silver', 2, 4, 2, 135.9),
    ('Antelope Mike', 'Golden Brown', 3, 2, 1, 185.3),
    ('Antelope November', 'Dark Gray', 4, 5, 2, 160.4),
    ('Antelope Oscar', 'Pale Yellow', 5, 3, 1, 195.7),
    ('Antelope Papa', 'Cream', 1, 4, 2, 150.0),
    ('Antelope Quebec', 'Light Gray', 2, 1, 1, 170.2),
    ('Antelope Romeo', 'Black', 3, 5, 1, 210.3),
    ('Antelope Sierra', 'Tan', 4, 2, 2, 140.8),
    ('Antelope Tango', 'White', 5, 3, 2, 155.7);
