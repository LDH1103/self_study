CREATE TABLE board_comments (
	comment_no INT AUTO_INCREMENT NOT NULL
	,board_no INT NOT NULL
	,comment_contents VARCHAR(100) NOT NULL
	,comment_write_date DATETIME NOT NULL
	,comment_del_flg INT NOT NULL DEFAULT 0
	,comment_del_date DATETIME
	,comment_nickname CHAR(15) NOT NULL
	,comment_password CHAR(15) NOT NULL
	,CONSTRAINT PK_BOARD_COMMENTS_BOARD_NO_COMMENT_NO PRIMARY KEY (comment_no, board_no)
	,FOREIGN KEY (board_no) REFERENCES board_info(board_no)
);

COMMIT;