ALTER TABLE `post`
  DROP COLUMN `author`;

ALTER TABLE `post`
  ADD COLUMN `user_id` int(11) NOT NULL;

ALTER TABLE `post`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);