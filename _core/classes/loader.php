<?php
	
	//Helpers
	include($ROOT_PATH."_core/classes/helpers/FX_System.php");	
	include($ROOT_PATH."_core/classes/helpers/FX_DateTime.php");	
	include($ROOT_PATH."_core/classes/helpers/FX_SimpleMail.php");
	include($ROOT_PATH."_core/classes/helpers/FX_FileHandler.php");		
	include($ROOT_PATH."_core/classes/helpers/FX_Date.php");
	include($ROOT_PATH."_core/classes/helpers/FX_UploadHandler.php");

	//Database
	include($ROOT_PATH."_core/classes/database/FX_DBConnection.php");	

	//Entities
	include($ROOT_PATH."_core/classes/entities/FX_BasicCRUD.php");
	include($ROOT_PATH."_core/classes/entities/FX_Author.php");
	include($ROOT_PATH."_core/classes/entities/FX_AuthorLang.php");
	include($ROOT_PATH."_core/classes/entities/FX_Contact.php");
	include($ROOT_PATH."_core/classes/entities/FX_ContactMessage.php");
	include($ROOT_PATH."_core/classes/entities/FX_Folder.php");
	include($ROOT_PATH."_core/classes/entities/FX_Form.php");
	include($ROOT_PATH."_core/classes/entities/FX_FormAnswer.php");
	include($ROOT_PATH."_core/classes/entities/FX_FormField.php");
	include($ROOT_PATH."_core/classes/entities/FX_FormFieldAnswer.php");
	include($ROOT_PATH."_core/classes/entities/FX_FormFieldLang.php");
	include($ROOT_PATH."_core/classes/entities/FX_FormLang.php");
	include($ROOT_PATH."_core/classes/entities/FX_FormPage.php");
	include($ROOT_PATH."_core/classes/entities/FX_FormPageLang.php");
	include($ROOT_PATH."_core/classes/entities/FX_Media.php");
	include($ROOT_PATH."_core/classes/entities/FX_Menu.php");	
	include($ROOT_PATH."_core/classes/entities/FX_MenuLang.php");
	include($ROOT_PATH."_core/classes/entities/FX_Order.php");
	include($ROOT_PATH."_core/classes/entities/FX_OrderComment.php");
	include($ROOT_PATH."_core/classes/entities/FX_OrderLine.php");
	include($ROOT_PATH."_core/classes/entities/FX_Page.php");
	include($ROOT_PATH."_core/classes/entities/FX_PageLang.php");
	include($ROOT_PATH."_core/classes/entities/FX_Post.php");
	include($ROOT_PATH."_core/classes/entities/FX_Product.php");
	include($ROOT_PATH."_core/classes/entities/FX_Section.php");
	include($ROOT_PATH."_core/classes/entities/FX_SectionLang.php");
	include($ROOT_PATH."_core/classes/entities/FX_SlideShow.php");
	include($ROOT_PATH."_core/classes/entities/FX_SlideShowLang.php");
	include($ROOT_PATH."_core/classes/entities/FX_Sys.php");
	include($ROOT_PATH."_core/classes/entities/FX_SysLang.php");
	include($ROOT_PATH."_core/classes/entities/FX_SysUser.php");
	include($ROOT_PATH."_core/classes/entities/FX_SysUserLog.php");
	include($ROOT_PATH."_core/classes/entities/FX_SlideShowImage.php");
	include($ROOT_PATH."_core/classes/entities/FX_SlideShowImageLang.php");
	include($ROOT_PATH."_core/classes/entities/FX_PageFile.php");
	include($ROOT_PATH."_core/classes/entities/FX_Design.php");
	include($ROOT_PATH."_core/classes/entities/FX_DesignPage.php");

	//include($ROOT_PATH."_core/classes/entities/FX_UploadHandler.php");
	//include($ROOT_PATH."_core/classes/entities/FX_CustomUploadHandler.php");	

	//Entities
	include($ROOT_PATH."_core/classes/entities/FX_Reports.php");
