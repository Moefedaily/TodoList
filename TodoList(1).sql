CREATE TABLE `tdl_priority` (
  `priority_id` int PRIMARY KEY,
  `name` varchar(255)
);

CREATE TABLE `tdl_users` (
  `user_id` int PRIMARY KEY,
  `first_name` varchar(255),
  `last_name` varchar(255),
  `password` varchar(255),
  `email` varchar(255)
);

CREATE TABLE `tdl_task` (
  `task_id` int PRIMARY KEY,
  `title` varchar(255),
  `description` text,
  `dueto` varchar(255),
  `completed` bool,
  `priority_id` int,
  `user_id` int
);


CREATE TABLE `tdl_category` (
  `category_id` int PRIMARY KEY,
  `name` varchar(255)
);

CREATE TABLE `tdl_task_has_category` (
  `task_id` int,
  `category_id` int
);

ALTER TABLE `tdl_task_has_category` ADD FOREIGN KEY (`category_id`) REFERENCES `tdl_category` (`category_id`);

ALTER TABLE `tdl_task_has_category` ADD FOREIGN KEY (`task_id`) REFERENCES `tdl_task` (`task_id`);

ALTER TABLE `tdl_task` ADD FOREIGN KEY (`priority_id`) REFERENCES `tdl_priority` (`priority_id`);

ALTER TABLE `tdl_task` ADD FOREIGN KEY (`user_id`) REFERENCES `tdl_users` (`user_id`);
