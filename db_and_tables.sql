CREATE DATABASE bluejack;

USE bluejack;

CREATE TABLE users (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	first_name VARCHAR(100) NOT NULL,
	last_name VARCHAR(100) NOT NULL,
	username VARCHAR(30) UNIQUE NOT NULL,
	password VARCHAR(255) NOT NULL,
	role VARCHAR(100) NOT NULL DEFAULT 'normal'
	);
	
CREATE TABLE pics (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL,
	category VARCHAR(255) DEFAULT 'generic',
	path VARCHAR(255) NOT NULL
	);

CREATE TABLE posts (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	post_title VARCHAR(255),
	post_content LONGTEXT,
	author_id INT,
	picture_id INT,
	public TINYINT,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	modified_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	img_reference VARCHAR(255),
	FOREIGN KEY(author_id) REFERENCES users(id),
	FOREIGN KEY(picture_id) REFERENCES pics(id)
	);

	
INSERT INTO pics (name, category, path)
VALUES
('architecture_640.jpg', 'industry', 'img/'),
('cat_640.jpg', 'creatures', 'img/'),
('caterpillar_640.jpg', 'creatures', 'img/'),
('clouds_640.jpg', 'nature', 'img/'),
('deer_640.jpg', 'creatures', 'img/'),
('dog_640.jpg', 'creatures', 'img/'),
('leaf_640.jpg', 'nature', 'img/'),
('milkyway_640.jpg', 'nature', 'img/'),
('mongoose_640.jpg', 'creatures', 'img/'),
('moon_640.jpg', 'creatures', 'img/'),
('moonlanding_640.jpg', 'industry', 'img/'),
('newspaper_640.jpg', 'industry', 'img/'),
('sea_640.jpg', 'nature', 'img/'),
('squirrel_640.jpg', 'creatures', 'img/'),
('sunrays_640.jpg', 'nature', 'img/'),
('sunset_640.jpg', 'nature', 'img/'),
('truth_640.jpg', 'industry', 'img/'),
('vintage-cameras_640.jpg', 'industry', 'img/');
	
INSERT INTO users (first_name, last_name, username, password, role)
VALUES
('The Phantom', 'of the Opera', 'admin', '$2y$10$HGls1Z.WkhyO2zFMP1p8aOekyzNRi1oz4dI89cfx/6DgyPEs.fgsS', 'admin'),
('Ion', 'Popescu', 'IonPopescu124', '$2y$10$8khRBUS7j20k10rrBxRkju1BhGjey7vSpFfBtviiRiyRqm/tkqc16', 'writer'),
('Pop', 'Ionescu', 'IonPopescu125', '$2y$10$Y0q8cvz/SDdJtsycjx2j4OfAlnfDO3/JJoQ3ubi36LQWnnkHE3Dg6', 'writer');

-- hashing for passwords 'admin123' & 'popescu124' & popescu125

INSERT INTO posts (post_title, post_content, author_id, picture_id, public)
VALUES
('Articol 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse aliquet rhoncus nibh, a placerat erat interdum id. Morbi fermentum, dolor vel scelerisque dictum, arcu metus euismod odio, at imperdiet metus dui eget leo. Phasellus in turpis nunc. Nulla sed nunc ac ante bibendum sollicitudin. In pharetra erat sed orci tempor, vitae ultricies mauris semper. In elementum quam sit amet neque accumsan, tincidunt sodales elit cursus.', 1, 1, 1),
('Articol 2', 'Nunc pretium quam turpis, eu eleifend massa blandit in. Fusce bibendum nulla neque, nec mattis dolor sagittis nec. Morbi vestibulum hendrerit dictum. Duis a nibh accumsan magna luctus ullamcorper. Nunc porta tellus in enim tristique aliquet.Maecenas luctus metus interdum libero pellentesque eleifend. In tincidunt feugiat feugiat. Morbi quis augue sit amet velit tristique pretium in a dolor. Suspendisse sit amet aliquam est. Morbi accumsan purus et ante semper, vel posuere mi tristique. Pellentesque vitae ipsum luctus, elementum sem non, mollis felis. Vestibulum nec lacus sagittis, placerat nulla vel, dictum turpis. Sed convallis mauris sem, et suscipit massa lobortis nec. ', 2, 2, 0),
('Articol 3', ' Etiam neque urna, faucibus pulvinar congue id, ultrices a risus. Phasellus lobortis odio id urna elementum tristique. Ut eu consequat ex, quis tristique risus. Curabitur id sem orci.Praesent sodales, ligula sed elementum mattis, libero leo lacinia ligula, vel cursus mi diam in velit. Sed vel neque vel nibh posuere imperdiet vel in nulla. Suspendisse sodales aliquam odio, id sodales nunc iaculis in. Curabitur sollicitudin tempor lorem, eget ornare magna auctor nec.', 3, 3, 0),
('Articol 4', 'Sed euismod dignissim nulla, non elementum velit sodales ut. Nulla a nibh id dolor blandit porta non sit amet purus. Aliquam euismod ipsum sed pulvinar mattis. Maecenas ullamcorper, mauris sed ullamcorper ullamcorper, lacus nisi varius diam, sit amet elementum diam quam id justo. Mauris gravida tellus eros. Morbi sed consectetur nisl. Aenean luctus fringilla libero. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vivamus blandit metus ut consectetur commodo. Suspendisse commodo mauris sed ligula lacinia, rhoncus interdum turpis vestibulum. ', 1, 4, 1),
('Articol 5', 'Phasellus maximus, turpis congue consectetur rutrum, lacus ex volutpat sem, pretium sodales lectus mi at lectus. Vivamus efficitur aliquam ligula pretium laoreet. Morbi sodales turpis at odio volutpat, vel suscipit elit congue. Vestibulum nec est a ex rutrum volutpat. Vestibulum non massa et sem gravida euismod. In hac habitasse platea dictumst. Donec eu metus fermentum, pulvinar ipsum eget, feugiat lorem. Ut euismod auctor arcu at hendrerit.', 2, 5, 0),
('Articol 6', 'In rhoncus risus et mauris euismod maximus. Aliquam nec sapien sapien. Phasellus eu sem non mi dapibus sagittis vitae a felis. Nullam id erat non quam hendrerit consequat quis nec sapien. Donec tempor malesuada lacus, ac tristique massa tempor at. Ut aliquet neque ac scelerisque sodales. In eu sollicitudin urna, ut porttitor velit. In hac habitasse platea dictumst. Aliquam volutpat pellentesque magna, sed condimentum enim. Donec vel mi a metus eleifend semper.', 1, 6, 1),
('Articol 7', 'Integer accumsan velit lectus, sed molestie purus lobortis cursus. In vestibulum ex ac pretium porttitor. Quisque imperdiet dui quis euismod facilisis. Vivamus et eleifend eros. Proin egestas dictum sem, vel fringilla erat porta nec. Fusce vulputate non odio convallis commodo. Suspendisse vestibulum lorem tortor, sit amet euismod elit feugiat sed. Duis imperdiet, turpis id porta scelerisque, lectus ex sollicitudin nisl, eu tempor magna ligula ac justo.', 2, 7, 1),
('Articol 8', 'Integer viverra dui non felis maximus, sit amet iaculis tortor feugiat. Aenean commodo et odio faucibus mattis. Nulla tempor orci vel nulla rhoncus, quis condimentum lectus congue. Aenean lobortis eu dolor vel maximus. Quisque et sagittis quam. Suspendisse aliquam dolor at sodales sagittis. Nullam semper purus a arcu volutpat congue. Sed ante purus, volutpat ac ornare id, imperdiet eget tellus. Aenean iaculis, quam ac dignissim imperdiet, odio ex sollicitudin turpis, ut finibus tellus elit eu libero.', 1, 8, 1),
('Articol 9', 'Mauris porta neque odio, ac mattis quam viverra in. Nulla ut mauris ut orci commodo pellentesque at ac magna. Phasellus laoreet dolor a risus ullamcorper convallis. Vivamus venenatis varius egestas. Nullam sollicitudin ultricies leo vel sagittis. Maecenas urna mi, pulvinar vel orci vel, aliquam tristique justo. Phasellus euismod malesuada pellentesque. Suspendisse potenti.', 2, 9, 1);

