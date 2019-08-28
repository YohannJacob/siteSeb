-- Doctrine Migration File Generated on 2019-08-27 12:24:04

-- Version 20190827121756
ALTER TABLE albums ADD cover_file VARCHAR(255) DEFAULT NULL, CHANGE cover_name cover_name VARCHAR(255) NOT NULL, CHANGE updated_at updated_at DATETIME NOT NULL;
INSERT INTO migration_versions (version, executed_at) VALUES ('20190827121756', CURRENT_TIMESTAMP);

-- Version 20190827121819
ALTER TABLE albums ADD cover_file VARCHAR(255) DEFAULT NULL, CHANGE cover_name cover_name VARCHAR(255) NOT NULL, CHANGE updated_at updated_at DATETIME NOT NULL;
INSERT INTO migration_versions (version, executed_at) VALUES ('20190827121819', CURRENT_TIMESTAMP);

-- Version 20190827122006
ALTER TABLE albums ADD cover_file VARCHAR(255) DEFAULT NULL, DROP updated_at, CHANGE cover_name cover_name VARCHAR(255) NOT NULL;
INSERT INTO migration_versions (version, executed_at) VALUES ('20190827122006', CURRENT_TIMESTAMP);
