<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/


$route['default_controller'] 		= 'index';
$route['404_override'] 				= 'index/error';
$route['500_override'] 				= 'index/error500';
$route['translate_uri_dashes'] 		= FALSE;

$route['agency/login'] 				= 'index/agencyLogin';
$route['client/login'] 				= 'index/clientLogin';
$route['loginUp'] 					= 'index/loginUp';
$route['logout'] 					= 'index/logout';

$route['forgot/password'] 			= 'index/forgotPassword';
$route['forgot/passwordUp'] 		= 'index/forgotPasswordUp';
$route['forgot/successful'] 		= 'index/forgotSuccessful';
$route['page-reset/(:any)'] 		= 'index/pageReset/$1';
$route['resetPasswordUp'] 			= 'index/resetPasswordUp';

/**************************Inner Module***********************/
$route['dashboard'] 				= 'front/front/dashboard';

$route['csr-overview'] 				= 'front/csrOverview';
$route['thematic-overview'] 		= 'front/thematicOverview';

$route['brief-module'] 				= 'front/briefModule/briefModule';
$route['briefModuleUp'] 			= 'front/briefModule/briefModuleUp';
$route['brief-module/edit/(:num)'] 	= 'front/briefModule/editBriefModule/$1';
$route['briefModuleUpdate'] 		= 'front/briefModule/briefModuleUpdate';

$route['planning-module'] 			= 'front/planningModule/planningModule';
$route['searchPlanning'] 			= 'front/planningModule/searchPlanning';
$route['unsetPlanning'] 			= 'front/planningModule/unsetPlanning';


$route['project-development'] 						= 'front/projectDevelopment/projectDevelopment';
$route['project-development/(:any)'] 				= 'front/projectDevelopment/projectDevelopmentForm/$1';
$route['projectDevelopmentStore/(:any)'] 			= 'front/projectDevelopment/projectDevelopmentStore/$1';
$route['projectDevelopmentUpdate/(:any)/(:any)'] 	= 'front/projectDevelopment/projectDevelopmentUpdate/$1/$2';
$route['projectDevelopmentFeedback/(:any)'] 		= 'front/projectDevelopment/projectDevelopmentFeedback/$1';
$route['searchProjectDevelopment'] 					= 'front/projectDevelopment/searchProjectDevelopment';
$route['unsetProjectDevelopment'] 					= 'front/projectDevelopment/unsetProjectDevelopment';

$route['needAssessment/(:any)'] 					= 'front/needAssessment';


$route['partner-identification'] 					= 'front/PartnerIdentification/partnerIdentification';
$route['searchPartnerIdentification'] 				= 'front/PartnerIdentification/searchPartnerIdentification';
$route['savePartnerIdentification'] 				= 'front/PartnerIdentification/savePartnerIdentification';
$route['unsetPartnerIdentification'] 				= 'front/PartnerIdentification/unsetPartnerIdentification';

$route['project-management'] 		        		= 'front/projectManagement/projectManagement';
$route['project-management/(:any)'] 				= 'front/projectManagement/projectManagementForm/$1';
$route['projectManagementStore/(:any)'] 			= 'front/projectManagement/projectManagementStore/$1';
$route['projectManagementUpdate/(:any)/(:any)'] 	= 'front/projectManagement/projectManagementUpdate/$1/$2';
$route['searchProjectManagement'] 					= 'front/projectManagement/searchProjectManagement';
$route['unsetProjectManagement'] 					= 'front/projectManagement/unsetProjectManagement';
$route['ngoExcelExport/(:any)'] 					= 'front/projectManagement/ngoExcelExport/$1';

$route['project-assessment'] 						= 'front/projectAssessment/projectAssessment';
$route['searchProjectAssessment'] 					= 'front/projectAssessment/searchProjectAssessment';
$route['unsetProjectAssessment'] 					= 'front/projectAssessment/unsetProjectAssessment';
$route['project-assessment/(:any)'] 				= 'front/projectAssessment/projectAssessmentReport/$1';

$route['beneficiary/(:any)'] 					= 'front/beneficiaryModule';
$route['monitoring/(:any)'] 					= 'front/monitoringReport';

$route['archives'] 									= 'front/archives/index';
$route['searchArchiveUp'] 							= 'front/archives/searchArchiveUp';

$route['report-archive'] 							= 'front/archives/reportArchive';
$route['searchReportArchives'] 						= 'front/archives/searchReportArchives';
$route['unsetReportArchives'] 						= 'front/archives/unsetReportArchives';
$route['downloadArchiveReport'] 					= 'front/archives/downloadArchiveReport';
$route['downloadMonitorReport'] 					= 'front/archives/downloadMonitorReport';
$route['downloadFinalReport'] 						= 'front/archives/downloadFinalReport';

/*************************Ajax************************************/
$route['front/ajax/viewBriefPopup'] 		= "front/ajax/viewBriefPopup";
$route['front/ajax/viewAssistedBy'] 		= "front/ajax/viewAssistedBy";
$route['front/ajax/updateStatus'] 			= "front/ajax/updateStatus";
$route['front/ajax/reportPlan'] 			= "front/ajax/reportPlan";
$route['front/ajax/uploadExcel'] 			= "front/ajax/uploadExcel";
$route['front/ajax/uploadRework'] 			= "front/ajax/uploadRework";
$route['front/ajax/actionPlan'] 			= "front/ajax/actionPlan";
$route['front/ajax/downloadPlanReport'] 	= "front/ajax/downloadPlanReport";
$route['front/ajax/downloadPlanRework'] 	= "front/ajax/downloadPlanRework";
/*************************End*************************************/

/****************Admin URLs Start***********************/
$route['admin'] 					= "admin/admin/index";
$route['admin/logout'] 				= "admin/admin/logout";
$route['admin/dashboard'] 			= "admin/admin/dashboard";
$route['admin/login'] 				= "admin/admin/login_up";
$route['admin/logout'] 				= "admin/admin/logout";

$route['admin/password/change'] 	= "admin/admin/changePassword";
$route['admin/password/update'] 	= "admin/admin/updatePassword";

/* -------------settings-------------*/
$route['admin/settings'] 			= "admin/settings/index";

/* -------------Roles-------------*/
$route['admin/settings/roles/display'] 			= "admin/settings/roleList";
$route['admin/settings/role/add']				= "admin/settings/addRole";
$route['admin/settings/role/insert']			= "admin/settings/insertRole";
$route['admin/settings/role/edit/(:num)'] 		= "admin/settings/editRole/$1";
$route['admin/settings/role/update']			= "admin/settings/updateRole";
$route['admin/settings/role/(:num)/(:any)'] 	= "admin/settings/changeStatusRole/$1/$2";

/* -------------Users-------------*/
$route['admin/settings/users/display'] 			= "admin/settings/userList";
$route['admin/settings/user/add']				= "admin/settings/addUser";
$route['admin/settings/user/insert']			= "admin/settings/insertUser";
$route['admin/settings/user/edit/(:num)'] 		= "admin/settings/editUser/$1";
$route['admin/settings/user/update']			= "admin/settings/updateUser";
$route['admin/settings/user/(:num)/(:any)'] 	= "admin/settings/changeStatusUser/$1/$2";

/* -------------Client-------------*/
$route['admin/settings/clients/display'] 		= "admin/settings/clientList";
$route['admin/settings/client/add']				= "admin/settings/addClient";
$route['admin/settings/client/insert']			= "admin/settings/insertClient";
$route['admin/settings/client/edit/(:num)'] 	= "admin/settings/editClient/$1";
$route['admin/settings/client/update']			= "admin/settings/updateClient";
$route['admin/settings/client/(:num)/(:any)'] 	= "admin/settings/changeStatusClient/$1/$2";

/* -------------Employees-------------*/
$route['admin/settings/employees/display'] 		= "admin/settings/employeeList";
$route['admin/settings/employee/add']			= "admin/settings/addEmployee";
$route['admin/settings/employee/insert']		= "admin/settings/insertEmployee";
$route['admin/settings/employee/edit/(:num)'] 	= "admin/settings/editEmployee/$1";
$route['admin/settings/employee/update']		= "admin/settings/updateEmployee";
$route['admin/settings/employee/(:num)/(:any)'] = "admin/settings/changeStatusEmployee/$1/$2";

/* -------------NGO-------------*/
$route['admin/settings/ngo/display'] 			= "admin/settings/ngoList";
$route['admin/settings/ngo/add']				= "admin/settings/addNgo";
$route['admin/settings/ngo/insert']				= "admin/settings/insertNgo";
$route['admin/settings/ngo/edit/(:num)'] 		= "admin/settings/editNgo/$1";
$route['admin/settings/ngo/update']			 	= "admin/settings/updateNgo";
$route['admin/settings/ngo/(:num)/(:any)'] 		= "admin/settings/changeStatusNgo/$1/$2";

/* -------------market-------------*/
$route['admin/settings/markets/display'] 		= "admin/settings/marketList";
$route['admin/settings/market/add']				= "admin/settings/addMarket";
$route['admin/settings/market/insert']			= "admin/settings/insertMarket";
$route['admin/settings/market/edit/(:num)'] 	= "admin/settings/editMarket/$1";
$route['admin/settings/market/update']			= "admin/settings/updateMarket";
$route['admin/settings/market/(:num)/(:any)'] 	= "admin/settings/changeStatusMarket/$1/$2";

/* -------------thematicArea-------------*/
$route['admin/settings/thematicAreas/display'] 			= "admin/settings/thematicAreaList";
$route['admin/settings/thematicArea/add']				= "admin/settings/addThematicArea";
$route['admin/settings/thematicArea/insert']			= "admin/settings/insertThematicArea";
$route['admin/settings/thematicArea/edit/(:num)'] 		= "admin/settings/editThematicArea/$1";
$route['admin/settings/thematicArea/update']			= "admin/settings/updateThematicArea";
$route['admin/settings/thematicArea/(:num)/(:any)'] 	= "admin/settings/changeStatusThematicArea/$1/$2";

/* -------------thematicArea-------------*/
$route['admin/settings/thematicArea/theme/display/(:num)']			= "admin/settings/themeList/$1";
$route['admin/settings/thematicArea/theme/add/(:num)']				= "admin/settings/addTheme/$1";
$route['admin/settings/thematicArea/theme/insert']					= "admin/settings/insertTheme";
$route['admin/settings/thematicArea/theme/edit/(:num)/(:num)'] 		= "admin/settings/editTheme/$1/$2";
$route['admin/settings/thematicArea/theme/update']					= "admin/settings/updateTheme";
$route['admin/settings/thematicArea/theme/(:num)/(:num)/(:any)'] 	= "admin/settings/changeStatusTheme/$1/$2/$3";

/* -------------Categories-------------*/
$route['admin/settings/categories/display'] 		= "admin/settings/categoryList";
$route['admin/settings/category/add']				= "admin/settings/addCategory";
$route['admin/settings/category/insert']			= "admin/settings/insertCategory";
$route['admin/settings/category/edit/(:num)'] 		= "admin/settings/editCategory/$1";
$route['admin/settings/category/update']			= "admin/settings/updateCategory";
$route['admin/settings/category/(:num)/(:any)'] 	= "admin/settings/changeStatusCategory/$1/$2";

/* -------------Archieves-------------*/
$route['admin/settings/archieves/display'] 			= "admin/settings/archieveList";
$route['admin/settings/archieve/add']				= "admin/settings/addArchieve";
$route['admin/settings/archieve/insert']			= "admin/settings/insertArchieve";
$route['admin/settings/archieve/edit/(:num)'] 		= "admin/settings/editArchieve/$1";
$route['admin/settings/archieve/update']			= "admin/settings/updateArchieve";
$route['admin/settings/archieve/(:num)/(:any)'] 	= "admin/settings/changeStatusArchieve/$1/$2";

/* -------------Teams-------------*/
$route['admin/settings/teams/display'] 				= "admin/settings/teamList";
$route['admin/settings/team/add']					= "admin/settings/addTeam";
$route['admin/settings/team/insert']				= "admin/settings/insertTeam";
$route['admin/settings/team/edit/(:num)'] 			= "admin/settings/editTeam/$1";
$route['admin/settings/team/update']				= "admin/settings/updateTeam";
$route['admin/settings/team/(:num)/(:any)'] 		= "admin/settings/changeStatusTeam/$1/$2";

/* -------------Brands-------------*/
$route['admin/settings/brands/display'] 			= "admin/settings/brandList";
$route['admin/settings/brand/add']					= "admin/settings/addBrand";
$route['admin/settings/brand/insert']				= "admin/settings/insertBrand";
$route['admin/settings/brand/edit/(:num)'] 			= "admin/settings/editBrand/$1";
$route['admin/settings/brand/update']				= "admin/settings/updateBrand";
$route['admin/settings/brand/(:num)/(:any)'] 		= "admin/settings/changeStatusBrand/$1/$2";

/* -------------CaseStudy-------------*/
$route['admin/settings/caseStudies/display'] 		= "admin/settings/caseStudyList";
$route['admin/settings/caseStudy/add']				= "admin/settings/addCaseStudy";
$route['admin/settings/caseStudy/insert']			= "admin/settings/insertCaseStudy";
$route['admin/settings/caseStudy/edit/(:num)'] 		= "admin/settings/editCaseStudy/$1";
$route['admin/settings/caseStudy/update']			= "admin/settings/updateCaseStudy";
$route['admin/settings/caseStudy/(:num)/(:any)']	= "admin/settings/changeStatusCaseStudy/$1/$2";

/* -------------Files-------------*/
$route['admin/settings/files/display'] 				= "admin/settings/archieveList";
$route['admin/settings/file/add']					= "admin/settings/addFile";
$route['admin/settings/file/insert']				= "admin/settings/insertFile";
$route['admin/settings/file/edit/(:num)'] 			= "admin/settings/editFile/$1";
$route['admin/settings/file/update']				= "admin/settings/updateFile";
$route['admin/settings/file/(:num)/(:any)'] 		= "admin/settings/changeStatusFile/$1/$2";

/* -------------States-------------*/
$route['admin/settings/states/display'] 			= "admin/settings/stateList";
$route['admin/settings/state/add'] 					= "admin/settings/addState";
$route['admin/settings/state/district'] 			= "admin/settings/addDistrict";
$route['admin/settings/state/insert'] 				= "admin/settings/insertState";
$route['admin/settings/state/edit/(:num)'] 			= "admin/settings/editState/$1";
$route['admin/settings/state/update'] 				= "admin/settings/updateState";
$route['admin/settings/state/(:num)/(:any)'] 		= "admin/settings/changeStatusState/$1/$2";

/* -------------Cities-------------*/
$route['admin/settings/cities/display'] 			= "admin/settings/cityList";
$route['admin/settings/city/add'] 					= "admin/settings/addCity";
$route['admin/settings/city/insert'] 				= "admin/settings/insertCity";
$route['admin/settings/city/edit/(:num)'] 			= "admin/settings/editCity/$1";
$route['admin/settings/city/update'] 				= "admin/settings/updateCity";
$route['admin/settings/city/(:num)/(:any)'] 		= "admin/settings/changeStatusCity/$1/$2";

/* -------------Assisted by-------------*/
$route['admin/settings/assistedBy/display'] 		= "admin/settings/assistedByList";
$route['admin/settings/assistedBy/add'] 			= "admin/settings/addAssistedBy";
$route['admin/settings/assistedBy/insert'] 			= "admin/settings/insertAssistedBy";
$route['admin/settings/assistedBy/edit/(:num)'] 	= "admin/settings/editAssistedBy/$1";
$route['admin/settings/assistedBy/update']		 	= "admin/settings/updateAssistedBy";
$route['admin/settings/assistedBy/(:num)/(:any)'] 	= "admin/settings/changeStatusAssistedBy/$1/$2";

/* -------------Sectors-------------*/
$route['admin/settings/sectors/display'] 			= "admin/settings/sectorList";
$route['admin/settings/sector/add'] 				= "admin/settings/addSector";
$route['admin/settings/sector/insert'] 				= "admin/settings/insertSector";
$route['admin/settings/sector/edit/(:num)'] 		= "admin/settings/editSector/$1";
$route['admin/settings/sector/update']		 		= "admin/settings/updateSector";
$route['admin/settings/sector/(:num)/(:any)'] 		= "admin/settings/changeStatusSector/$1/$2";

/*----------------LOCATTION MODULE --------------- */
$route['admin/settings/csroverview/display'] 	    = "admin/settings/csr_overview";
$route['admin/settings/csroverview/edit'] 		    = "admin/settings/editCSRProjectCount";
$route['admin/settings/csroverview/update'] 		= "admin/settings/updateCSRProjectCount";
$route['admin/settings/csroverview/bulkUpload'] 	= "admin/settings/csrBulkUpload";
$route['admin/settings/thematicOverview/display'] 	= "admin/settings/thematic_overview";
$route['admin/settings/needAssessment/display'] 	= "admin/settings/need_assessment";
$route['admin/settings/beneficiary/display'] 	    = "admin/settings/beneficiary_module";
$route['admin/settings/reporting/display'] 	        = "admin/settings/reporting_module";


/* --------------Bulk-Upload ----------------*/
$route['admin/bulkUploadThematicArea'] 				= "admin/bulkUpload/thematicArea";
$route['admin/bulkUploadThematicAreaStore'] 	    = "admin/bulkUpload/thematicAreaStore";

$route['admin/bulkUploadMarket'] 					= "admin/bulkUpload/market";
$route['admin/bulkUploadMarketStore'] 	    		= "admin/bulkUpload/marketStore";

$route['admin/bulkUploadCSROverview'] 	    		= "admin/bulkUpload/csrOverview";
$route['admin/bulkUploadThematicState'] 	    	= "admin/bulkUpload/thematicState";
$route['admin/bulkUploadThematicMaster'] 	    	= "admin/bulkUpload/thematicMaster";
$route['admin/bulkUploadPerformanceParameter'] 	    = "admin/bulkUpload/performanceParameter";

$route['admin/bulkUploadKeyPerformanceData'] 	    = "admin/bulkUpload/keyPerformanceData";
$route['admin/bulkUploadKeyDistributionData'] 	    = "admin/bulkUpload/keyDistributionData";

$route['admin/bulkUploadDistrictData'] 	    = "admin/bulkUpload/districtData";


$route['admin/bulkUploadNGO'] 						= "admin/bulkUpload/NGO";
$route['admin/bulkUploadNGOStore'] 	    			= "admin/bulkUpload/NGOStore";

/* --------------Ajax ----------------*/
$route['admin/ajax/showTheme'] 						= "admin/ajax/showTheme";
$route['admin/ajax/showCity'] 						= "admin/ajax/showCity";