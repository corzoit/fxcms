<?php
	$FX_ROUTES = array();

	$FX_ROUTES[] = array(
			'path' => array(
				'/admin',		
				),
			'view_file' => 'admin/index.php'				
		);

	/* ADMIN LOGIN */
		$FX_ROUTES[] = array(
					'path' => array(
						'/admin/login',		
						),
					'view_file' => 'admin/login.php'				
				);

		$FX_ROUTES[] = array(
				'path' => array(
					'/admin/logout',		
					),
				'view_file' => 'admin/logout.php'				
			);

		$FX_ROUTES[] = array(
				'path' => array(
					'/admin/forgot',		
					),
				'view_file' => 'admin/forgot.php'				
			);

		$FX_ROUTES[] = array(
			'path' => array(				
				'/admin/password/update/{id}',
				),
			'view_file' => 'admin/password_update.php'
		);				
	/* END ADMIN LOGIN */

	/* ADMIN ACCOUNT */
		$FX_ROUTES[] = array(
				'path' => array(
					'/admin/account',		
					),
				'view_file' => 'admin/account.php'				
			);
	/* END ADMIN ACCOUNT */	
	

	/* ADMIN CONTENT MANAGER */

		$FX_ROUTES[] = array(
				'path' => array(
					'/admin/page/manager',
					),
				'view_file' => 'admin/page/content_manager.php'				
			);

		$FX_ROUTES[] = array(
				'path' => array(
					'/admin/page/add',		
					),
				'view_file' => 'admin/page/add_page.php'
			);
		
		$FX_ROUTES[] = array(
				'path' => array(
					'/admin/page/edit/{id}',		
					),
				'view_file' => 'admin/page/edit_page.php'				
			);

		$FX_ROUTES[] = array(
				'path' => array(
					'/admin/page/galery',		
					),
				'view_file' => 'admin/page/page_galery.php'				
			);

	/* END ADMIN CONTENT MANAGER */ 


	/* ADMIN CONTACT MANAGER */
		
		$FX_ROUTES[] = array(
			'path' => array(
				'/admin/contact',
				'/admin/contact/manager',
				'/admin/contact/result/{pag}',		
				),
			'view_file' => 'admin/contact/manager.php'				
		);

	/* END ADMIN CONTACT MANAGER */

	/*ADMIN MENU*/

		$FX_ROUTES[] = array(
				'path' => array(
					'/admin/menu/manager',		
					),
				'view_file' => 'admin/menu/menu.php'				
			);

	/*END ADMIN MENU*/
	
	/*ADMIN FORM*/
		$FX_ROUTES[] = array(
				'path' => array(
					'/admin/form/edit',
					'/admin/form/edit/{id}',		
					),
				'view_file' => 'admin/form/edit.php'				
			);

		$FX_ROUTES[] = array(
				'path' => array(
					'/admin/form/field/{id}',		
					),
				'view_file' => 'admin/form/field.php'				
			);

		$FX_ROUTES[] = array(
			'path' => array(
				'/admin/form/manager',		
				),
			'view_file' => 'admin/form/manager.php'				
		);		
	/**/

	/* SLIDESHOW */
		$FX_ROUTES[] = array(
			'path' => array(
				'/admin/slideshow/manager',		
				),
			'view_file' => 'admin/slideshow/manager.php'				
		);

		$FX_ROUTES[] = array(
			'path' => array(
				'/admin/slideshow/edit',
				'/admin/slideshow/edit/{id}',		
				),
			'view_file' => 'admin/slideshow/edit.php'				
		);
	/* END SLIDESHOW */

	/* COMMENT */
		$FX_ROUTES[] = array(
			'path' => array(
				'/admin/comment/manager',		
				),
			'view_file' => 'admin/comment/manager.php'				
		);

		$FX_ROUTES[] = array(
			'path' => array(
				'/admin/comment/page/{id}',		
				),
			'view_file' => 'admin/comment/page.php'				
		);

		$FX_ROUTES[] = array(
			'path' => array(
				'/admin/comment/edit/{id}',		
				),
			'view_file' => 'admin/comment/edit.php'				
		);

	/* END COMMENT */

	/* MEDIA */
		$FX_ROUTES[] = array(
			'path' => array(
				'/admin/media/',
				),
			'view_file' => 'admin/media/media.php'				
		);
	/* END MEDIA */

	/* DESIGN */
		$FX_ROUTES[] = array(
			'path' => array(
				'/admin/design/',
				),
			'view_file' => 'admin/design/design.php'				
		);
		$FX_ROUTES[] = array(
			'path' => array(
				'/admin/design/{design_id}',
				),
			'view_file' => 'admin/design/edit_design.php'				
		);
	/* END DESIGN */

	/* LIST IMAGE */
	$FX_ROUTES[] = array(
		'path' => array(
			'/admin/list/',
			),
		'view_file' => 'admin/list.php'				
	);

	/* UPLOAD IMAGE */
	$FX_ROUTES[] = array(
		'path' => array(
			'/admin/page/jquery_file_upload/',
			),
		'view_file' => 'admin/page/jquery_file_upload/index.php'				
	);

	/* TESTING */
		$FX_ROUTES[] = array(
			'path' => array(
				'/admin/inserttest',		
				),
			'view_file' => 'admin/inserttest.php'				
		);
	/* END TESTING */

////////////////////////////////////////////////////////////////////////

	
/*********************************************************************/
	/* TEMPLATE 2 CLIENT */
		$FX_ROUTES[] = array(
			'path' => array(
				'/{language}',		
				),
			'view_file' => 'client/index.php'
		);
		
		$FX_ROUTES[] = array(
			'path' => array(
				'/{language}/test/{page_id}',		
				),
			'view_file' => 'client/test.php'
		);
		
		$FX_ROUTES[] = array(
			'path' => array(				
				'/{language}/section/{sec_id}',
                '/{language}/section/{sec_id}/{sub_id}',
				),
			'view_file' => 'client/section.php'
		);

		$FX_ROUTES[] = array(
			'path' => array(				
				'/{language}/page/{page_id}',                
				),
			'view_file' => 'client/page.php'
		);

		$FX_ROUTES[] = array(
			'path' => array(				
				'/{language}/test',
				),
			'view_file' => 'client/test.php'
		);

		$FX_ROUTES[] = array(
			'path' => array(				
				'/contact',
				),
			'view_file' => 'client/contact.php'
		);
	/* END TEMPLATE 2 CLIENT */
