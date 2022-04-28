create table devices(
device_id INT AUTO_INCREMENT,
device_name varchar(24),
PRIMARY KEY (device_id)
);

INSERT INTO devices (device_id) value("1");
INSERT INTO devices (device_id) value("2");
INSERT INTO devices (device_id) value("3");

INSERT INTO devices (device_name) value("temperature_sensor");
INSERT INTO devices (device_name) value("battery_sensor");
INSERT INTO devices (device_name) value("water_sensor");


