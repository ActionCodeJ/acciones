ALTER TABLE `user_entities` ADD `created_at` DATE NULL AFTER `observacion`, ADD `updated_at` DATE NULL AFTER `created_at`;
ALTER TABLE `user_entities` CHANGE `id_entity` `entity_id` BIGINT(20) NOT NULL;
ALTER TABLE `user_entities` CHANGE `id_user` `user_id` BIGINT(20) NOT NULL;
ALTER TABLE `users` ADD `documento` VARCHAR(10) NULL AFTER `last_name`;