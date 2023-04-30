CREATE TABLE board_info (
	board_no INT AUTO_INCREMENT NOT NULL PRIMARY KEY
	,board_views INT NOT NULL DEFAULT 0
	,board_title VARCHAR(30) NOT NULL
	,board_content VARCHAR(1000) NOT NULL
	,board_write_date DATETIME NOT NULL
	,board_del_flg INT NOT NULL DEFAULT 0
	,board_del_date DATETIME
	,board_good_num INT NOT NULL DEFAULT 0
	,board_bad_num INT NOT NULL DEFAULT 0
	,board_img_path VARCHAR(1000)
	,board_img_name VARCHAR(256)
);

COMMIT;
