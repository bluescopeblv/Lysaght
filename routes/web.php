<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\TheLoai;

// Route::get('/', function () {
//     return view('w');
// });

/*Route::get('thu', function () {
	$theloai = TheLoai::find(1);

	foreach ($theloai->loaitin as $loaitin1) {
		echo $loaitin1->Ten."<br>";
		//var_dump($loaitin1);
	}
});*/

Route::get('thu', function () {
	return view('admin.theloai.danhsach');
});

Route::get('admin/dangnhap','UserController@getDangNhapAdmin');
Route::post('admin/dangnhap','UserController@postDangNhapAdmin');
Route::get('admin/logout','UserController@getDangXuatAdmin');

Route::group(['prefix' => 'admin','middleware'=> 'adminLogin'], function() {
    Route::group(['prefix' => 'theloai'], function() {
    	//admin/theloai/danh sach
        Route::get('danhsach','TheLoaiController@getDanhSach');

    	Route::get('sua/{id}','TheLoaiController@getSua');
    	Route::post('sua/{id}','TheLoaiController@postSua');

    	Route::get('them','TheLoaiController@getThem');
    	Route::post('them','TheLoaiController@postThem');

    	Route::get('xoa/{id}','TheLoaiController@getXoa');

    });

    Route::group(['prefix' => 'loaitin'], function() {
    	//admin/theloai/danh sach
        Route::get('danhsach','LoaiTinController@getDanhSach');

    	Route::get('sua/{id}','LoaiTinController@getSua');
    	Route::post('sua/{id}','LoaiTinController@postSua');

    	Route::get('them','LoaiTinController@getThem');
    	Route::post('them','LoaiTinController@postThem');

    	Route::get('xoa/{id}','LoaiTinController@getXoa');
    });

    Route::group(['prefix' => 'tintuc'], function() {
    	//admin/loaitin/danh sach
        Route::get('danhsach','TinTucController@getDanhSach');

    	Route::get('sua/{id}','TinTucController@getSua');
    	Route::post('sua/{id}','TinTucController@postSua');
    	
    	Route::get('them','TinTucController@getThem');
		Route::post('them','TinTucController@postThem');

        Route::get('xoa/{id}','TinTucController@getXoa');
    });

    Route::group(['prefix' => 'comment'], function() {
    	
    	Route::get('xoa/{id}/{idTinTuc}','CommentController@getXoa');
		
    });

    Route::group(['prefix' => 'slide'], function() {
    	//admin/loaitin/danh sach
        Route::get('danhsach','SlideController@getDanhSach');

    	Route::get('sua/{id}','SlideController@getSua');
    	Route::post('sua/{id}','SlideController@postSua');
    	
    	Route::get('them','SlideController@getThem');
		Route::post('them','SlideController@postThem');

		Route::get('xoa/{id}','SlideController@getXoa');
    });

    Route::group(['prefix' => 'user'], function() {
    	//admin/loaitin/danh sach
        Route::get('danhsach','UserController@getDanhSach');

    	Route::get('sua/{id}','UserController@getSua');
    	Route::post('sua/{id}','UserController@postSua');
    	
    	Route::get('them','UserController@getThem');
		Route::post('them','UserController@postThem');

		Route::get('xoa/{id}','UserController@getXoa');
    });

    Route::group(['prefix' => 'maintenance'], function() {
        //admin/loaitin/danh sach
        Route::get('danhsach','MaintenanceController@getDanhSachAdmin');

        Route::get('sua/{id}','MaintenanceController@getSua');
        Route::post('sua/{id}','MaintenanceController@postSua');

        Route::get('sua_chiso/{id}','MaintenanceController@getSuaChiSo');
        Route::post('sua_chiso/{id}','MaintenanceController@postSuaChiSo');

        Route::get('resetall','MaintenanceController@getResetall');
        
        Route::get('them','MaintenanceController@getThem');
        Route::post('them','MaintenanceController@postThem');

        //Route::get('xoa/{id}','UserController@getXoa');

    });

    Route::group(['prefix' => 'prel3'], function() {
        //admin/loaitin/danh sach
        Route::get('danhsachwc','Prel3Controller@getDanhSachWCAdmin');

        Route::get('suawc/{id}','Prel3Controller@getSuaWC');
        Route::post('suawc/{id}','Prel3Controller@postSuaWC');
        
        Route::get('themwc','Prel3Controller@getThemWC');
        Route::post('themwc','Prel3Controller@postThemWC');

        //Route::get('xoa/{id}','UserController@getXoa');
    });

    Route::group(['prefix' => 'activity'], function() {
        //admin/loaitin/danh sach
        Route::get('/','ActivityController@getList_Admin');

        Route::get('add','ActivityController@getThem_Admin');
        Route::post('add','ActivityController@postThem_Admin');

        Route::get('edit/{id}','ActivityController@getEdit_Admin');
        Route::post('edit/{id}','ActivityController@postEdit_Admin');
        
        Route::get('/registed/{id}','ActivityController@getRegisted');
        
        

        Route::get('xoa/{id}','UserController@getXoa');
    });

    Route::group(['prefix' => 'fives'], function() {
        //admin/loaitin/danh sach
        Route::group(['prefix' => 'question'], function() {
            Route::get('/','FiveSController@getListCauHoi_Admin');

            Route::get('add','FiveSController@getAddCauHoi_Admin');
            Route::post('add','FiveSController@postAddCauHoi_Admin');

            Route::get('edit/{id}','FiveSController@getEdit_Admin');
            Route::post('edit/{id}','FiveSController@postEdit_Admin');
            
            Route::get('delete/{id}','FiveSController@getDelete_Admin');
        });

        Route::group(['prefix' => 'question-group'], function() {
            Route::get('/','FiveSController@getList_Group_CauHoi_Admin');

            Route::get('add','FiveSController@getAdd_Group_CauHoi_Admin');
            Route::post('add','FiveSController@postAdd_Group_CauHoi_Admin');

            Route::get('edit/{id}','FiveSController@getEdit_Group_CauHoi_Admin');
            Route::post('edit/{id}','FiveSController@postEdit_Group_CauHoi_Admin');
            
            Route::get('delete/{id}','FiveSController@getDelete_Group_CauHoi_Admin');
            
            

            Route::get('xoa/{id}','UserController@getXoa');
        });

        Route::group(['prefix' => 'nhanvien-group'], function() {
            Route::get('/','FiveSController@getList_Group_Nhanvien_Admin');

            Route::get('add','FiveSController@getAdd_Group_Nhanvien_Admin');
            Route::post('add','FiveSController@postAdd_Group_Nhanvien_Admin');

            Route::get('edit/{id}','FiveSController@getEdit_Group_Nhanvien_Admin');
            Route::post('edit/{id}','FiveSController@postEdit_Group_Nhanvien_Admin');
            
            Route::get('delete/{id}','FiveSController@getDelete_Group_Nhanvien_Admin');
        });

        Route::group(['prefix' => 'nhanvien'], function() {
            Route::get('/','FiveSController@getList_Nhanvien_Admin');

            Route::get('add','FiveSController@getAdd_Nhanvien_Admin');
            Route::post('add','FiveSController@postAdd_Nhanvien_Admin');

            Route::get('edit/{id}','FiveSController@getEdit_Nhanvien_Admin');
            Route::post('edit/{id}','FiveSController@postEdit_Nhanvien_Admin');
            
            Route::get('delete/{id}','FiveSController@getDelete_Nhanvien_Admin');
        });

        Route::group(['prefix' => 'campaign'], function() {
            Route::get('/','FiveSController@getList_Campaign_Admin');

            Route::get('add','FiveSController@getAdd_Campaign_Admin');
            Route::post('add','FiveSController@postAdd_Campaign_Admin');

            Route::get('edit/{id}','FiveSController@getEdit_Campaign_Admin');
            Route::post('edit/{id}','FiveSController@postEdit_Campaign_Admin');
            
            Route::get('delete/{id}','FiveSController@getDelete_Campaign_Admin');
        });
    });

    Route::group(['prefix' => 'ajax'], function() {
    	//admin/loaitin/danh sach
        Route::get('loaitin/{idTheLoai}','AjaxController@getLoaiTin');	
    });

    Route::group(['prefix' => 'outmaint'], function() {
        Route::group(['prefix' => 'type'], function() {
            Route::get('/','OutMaintTypeController@getListAdmin');

            Route::get('add','OutMaintTypeController@getAddAdmin');
            Route::post('add','OutMaintTypeController@postAddAdmin');

            Route::get('edit/{id}','OutMaintTypeController@getEditAdmin');
            Route::post('edit/{id}','OutMaintTypeController@postEditAdmin');
        });

        Route::group(['prefix' => 'machine'], function() {
            Route::get('/','OutMaintMachineController@getListAdmin');

            Route::get('add','OutMaintMachineController@getAddAdmin');
            Route::post('add','OutMaintMachineController@postAddAdmin');

            Route::get('edit/{id}','OutMaintMachineController@getEditAdmin');
            Route::post('edit/{id}','OutMaintMachineController@postEditAdmin');
        });
        
    });
});

Route::get('/','PagesController@trangchu');
Route::get('trangchu','PagesController@trangchu');
Route::get('lienhe','PagesController@lienhe');
Route::get('loaitin/{id}/{TenKhongDau}.html','PagesController@loaitin');
Route::get('tintuc/{id}/{TenKhongDau}.html','PagesController@tintuc');
Route::get('dangnhap','PagesController@getDangNhap');
Route::post('dangnhap','PagesController@postDangNhap');
Route::get('dangxuat','PagesController@getDangXuat');
Route::get('nguoidung','PagesController@getNguoiDung');
Route::post('nguoidung','PagesController@postNguoiDung');
Route::get('dangky','PagesController@getDangKy');
Route::post('dangky','PagesController@postDangKy');

Route::get('member','PagesController@trangchu_v2');


Route::post('comment/{id}','CommentController@postComment');

Route::post('timkiem','PagesController@postTimKiem');

Route::get('kehoach','KeHoachController@getKeHoach');
Route::post('kehoach','KeHoachController@postKeHoach');
Route::get('thongke','KeHoachController@getThongKe');
Route::post('thongke','KeHoachController@postThongKe');

Route::get('chitiet/{CO}/{LItem}/{wc}/{date}/{TT}','KeHoachController@getChiTiet');

Route::get('chitiet/{id}','AjaxController@getChiTietCO');
Route::get('reportXong/{id}','AjaxController@getReportXong');
Route::get('chitiet/{CO}/{LItem}/{wc}/{date}/{TT}/reportall','KeHoachController@getReportAll');

Route::post('reportMotPhan/{id}','AjaxController@postReportMotPhan');

Route::get('feedback','KeHoachController@getFeedback');
Route::post('feedback','KeHoachController@postFeedback');

Route::get('thongbao_dadoc/{id}','KeHoachController@getThongBaoDaDoc');
Route::post('feedback_tk','KeHoachController@postFeedbackTimKiem');
Route::get('feedback_tk','KeHoachController@getFeedbackTimKiem');

//------------------------------------------------------------------
// V2 - PRE L3 KE HOACH
//------------------------------------------------------------------
    Route::group(['prefix' => 'kehoach'], function() {
        Route::group(['prefix' => 'foreman'], function() {
            Route::get('/','KeHoach2Controller@getList_FM');
            Route::post('/','KeHoach2Controller@postList_FM');
        });

        Route::group(['prefix' => 'interface'], function() {
            Route::get('/{wc_id}','KeHoach2Controller@Interface_getWorkcenter');
            

        });

    });






//------------------------------------------------------------------

Route::group(['prefix' => 'fives'], function() {
    Route::get('/','FiveSController@get5S');
    Route::post('/','FiveSController@post5S');

    Route::get('/chitiet/{id}','FiveSController@get5Schitiet');
    Route::post('/chitiet/{id}','FiveSController@post5Schitiet');

    Route::group(['prefix' => 'thongke'], function() {
        Route::get('/','FiveSController@getThongKe5S');

    });

    // fives/export
    Route::group(['prefix' => 'export'], function() {
        Route::get('excel','FiveSController@getExportExcel');

        Route::get('export-list/{type}', 'FiveSController@get5sList')->name('export.5s.list');

    });
    //evaluate
    Route::group(['prefix' => 'evaluate'], function() {
        Route::get('/','FiveSController@getList_AllFunction');
        //--campaign
        Route::group(['prefix' => 'campaign'], function() {
            Route::get('/','FiveSController@getList_Campaign');

            Route::get('add','FiveSController@getAdd_Campaign');
            Route::post('add','FiveSController@postAdd_Campaign');

            Route::get('edit/{id}','FiveSController@getEdit_Campaign');
            Route::post('edit/{id}','FiveSController@postEdit_Campaign');
            
            Route::get('delete/{id}','FiveSController@getDelete_Campaign');
        });
        //main - chấm điểm
        Route::group(['prefix' => 'main'], function() {
            Route::get('/{id}','FiveSController@getList_Main');

            Route::get('add/{id}','FiveSController@getAdd_Main');
            Route::post('add/{id}','FiveSController@postAdd_Main');

            Route::get('edit/{id}','FiveSController@getEdit_Main');
            Route::post('edit/{id}','FiveSController@postEdit_Main');
            
            Route::get('delete/{id}','FiveSController@getDelete_Main');

            Route::get('question/{id}','FiveSController@getQuestion_Main');
        });
        //Maint Câu hỏi
        Route::group(['prefix' => 'question'], function() {
            Route::get('/','FiveSController@getListCauHoi_Admin');

            Route::get('add','FiveSController@getAddCauHoi_Admin');
            Route::post('add','FiveSController@postAddCauHoi_Admin');

            Route::get('edit/{id}','FiveSController@getEdit_Admin');
            Route::post('edit/{id}','FiveSController@postEdit_Admin');
            
            Route::get('delete/{id}','FiveSController@getDelete_Admin');
        });

        Route::group(['prefix' => 'question-group'], function() {
            Route::get('/','FiveSController@getList_Group_CauHoi_Admin');

            Route::get('add','FiveSController@getAdd_Group_CauHoi_Admin');
            Route::post('add','FiveSController@postAdd_Group_CauHoi_Admin');

            Route::get('edit/{id}','FiveSController@getEdit_Group_CauHoi_Admin');
            Route::post('edit/{id}','FiveSController@postEdit_Group_CauHoi_Admin');
            
            Route::get('delete/{id}','FiveSController@getDelete_Group_CauHoi_Admin');
            
            

            Route::get('xoa/{id}','UserController@getXoa');
        });

        // V2 FS Group
        Route::group(['prefix' => 'fs-group'], function() {
            Route::get('/','FiveS2Controller@getList_FSGroup');

            Route::get('add','FiveS2Controller@getAdd_FSGroup');
            Route::post('add','FiveS2Controller@postAdd_FSGroup');

            Route::get('edit/{id}','FiveS2Controller@getEdit_FSGroup');
            Route::post('edit/{id}','FiveS2Controller@postEdit_FSGroup');
            
            Route::get('delete/{id}','FiveS2Controller@getDelete_FSGroup');
        });

        // V2 Main - Kết quả Chấm điểm THEO BIG GROUP
        Route::group(['prefix' => 'result'], function() {

            Route::get('/{id}','FiveS2Controller@getList_Result');
        });

        // V2 Main - Kết quả Chấm điểm THEO BIG GROUP
        Route::group(['prefix' => 'campaign2'], function() {
            Route::get('/','FiveS2Controller@getList_Campaign');

            
        });

        Route::group(['prefix' => 'nhanvien-group'], function() {
            Route::get('/','FiveSController@getList_Group_Nhanvien');

            Route::get('add','FiveSController@getAdd_Group_Nhanvien');
            Route::post('add','FiveSController@postAdd_Group_Nhanvien');

            Route::get('edit/{id}','FiveSController@getEdit_Group_Nhanvien');
            Route::post('edit/{id}','FiveSController@postEdit_Group_Nhanvien');
            
            Route::get('delete/{id}','FiveSController@getDelete_Group_Nhanvien');
        });

        Route::group(['prefix' => 'nhanvien'], function() {
            Route::get('/','FiveSController@getList_Nhanvien');

            Route::get('add','FiveSController@getAdd_Nhanvien');
            Route::post('add','FiveSController@postAdd_Nhanvien');

            Route::get('edit/{id}','FiveSController@getEdit_Nhanvien');
            Route::post('edit/{id}','FiveSController@postEdit_Nhanvien');
            
            Route::get('delete/{id}','FiveSController@getDelete_Nhanvien');
        });
    });

    Route::group(['prefix' => 'report'], function() {
        Route::get('/','FiveSReportController@getList_Main_Report');

        Route::get('chart-campaign','FiveSReportController@get_chart_campaign');
        Route::get('chart-group','FiveSReportController@get_chart_group');

        Route::get('edit/{id}','FiveSReportController@getEdit_Main');
        Route::post('edit/{id}','FiveSReportController@postEdit_Main');
        
        Route::get('delete/{id}','FiveSReportController@getDelete_Main');

        Route::get('question/{id}','FiveSReportController@getQuestion_Main');
    });
    

});

Route::get('baoloi-danhsach','BaoLoiController@getBaoLoi');
Route::post('baoloi-themloi','BaoLoiController@postThemLoi');

Route::get('baoloi-sua/{id}','BaoLoiController@getBaoLoiSua');
Route::post('baoloi-sua/{id}','BaoLoiController@postBaoLoiSua');

Route::get('phonebook', 'PhonebookController@getPhonebook');
Route::post('phonebook', 'PhonebookController@postPhonebook');

Route::get('HDTutoMail', function() {
    $user = \App\User::find(14);
    Mail::to($user->email)->send(new \App\Mail\HDTutoMail($user));
    dd("Email is Send.");
});
Route::get('send-main', 'MailController@sendMail');

Route::get('sendMailFeedback', 'MailController@getSendMailFeedback');

Route::group(['prefix' => 'maintenance'], function() {
    
    Route::get('thongke','MaintenanceController@getThongKeChart');
});
Route::get('maintenance', 'MaintenanceController@getDanhSach');
Route::get('maint_quanlychiphi', 'MaintenanceController@getQuanLyChiPhi');
Route::get('maint_quanlychiphi/them', 'MaintenanceController@getThemRecordChiPhi');
Route::post('maint_quanlychiphi/them', 'MaintenanceController@postThemRecordChiPhi');
Route::get('maint_quanlychiphi/sua/{id}', 'MaintenanceController@getSuaRecordChiPhi');
Route::post('maint_quanlychiphi/sua/{id}', 'MaintenanceController@postSuaRecordChiPhi');
Route::get('maint_quanlychiphi/xoa/{id}', 'MaintenanceController@getXoaRecordChiPhi');
Route::post('a', 'MaintenanceController@a');


Route::get('bar-chart', 'ChartController@getChart');
Route::get('create-chart/{type}','ChartController@makeChart');

//Excel-------------------------------------------------------------------------
Route::get('import-export-view', 'ExcelController@importExportView')->name('import.export.view');
Route::post('import-file', 'ExcelController@importFile')->name('import.file');
Route::get('export-file/{type}', 'ExcelController@exportFile')->name('export.file');
Route::get('export-maint-chungtuthanhtoan/{type}', 'ExcelController@getReportChungTuThanhToan')->name('export.file');

//End route Excel---------------------------------------------------------------

//Charts------------------------------------------------------------------------
Route::get('test', 'ChartsController@chart');
Route::get('chart_bar', 'ChartsController@chart_bar');
//------------------------------------------------------------------------------
// Delivery
Route::get('delivery1', 'DeliveryController@getDanhSach');
Route::get('delivery_danhsach', 'DeliveryController@getDanhSach');
Route::get('delivery_themthongtin', 'DeliveryController@getThemThongTin');
Route::post('delivery_themthongtin', 'DeliveryController@postThemThongTin');

Route::post('delivery_themthongtin_import', 'DeliveryController@import_thongtinxe')->name('import.thongtinxe');;

Route::get('export-delivery/{type}', 'DeliveryController@export_thongtinxe')->name('export.thongtinxe');
Route::get('delivery/xoa/{id}', 'DeliveryController@getXoa');
Route::get('delivery/sua/{id}', 'DeliveryController@getSuaThongTin');
Route::post('delivery/sua/{id}', 'DeliveryController@postSuaThongTin');

//------------------------------------------------------------------
// Hoạt động
//------------------------------------------------------------------
Route::group(['prefix' => 'activity'], function() {
        //admin/loaitin/danh sach
        Route::get('/','ActivityController@getList');

        Route::get('/register/{id}','ActivityController@getRegister');
        Route::post('/register/{id}','ActivityController@postRegister');
        
        Route::get('/registed/{id}','ActivityController@getRegisted');
        
        Route::post('them','UserController@postThem');

        Route::get('xoa/{id}','UserController@getXoa');
    });
//------------------------------------------------------------------

//------------------------------------------------------------------
// Delivery
Route::group(['prefix' => 'delivery'], function() {
    Route::get('/', 'DeliveryController@getDanhSach');

    Route::group(['prefix' => 'baove'], function() {
        Route::get('/','DeliveryController@getListBV');

        Route::get('/add', 'DeliveryController@getAddBV');
        Route::post('/add', 'DeliveryController@postAddBV');

        Route::get('/edit/{id}','DeliveryController@getEditBV');
        Route::post('/edit/{id}','DeliveryController@postEditBV');

        Route::get('/delete/{id}','DeliveryController@getDeleteBV');

        Route::get('/in/{id}','DeliveryController@getIn_BV');
        Route::get('/out/{id}','DeliveryController@getOutBV');
    });
    Route::group(['prefix' => 'logistic'], function() {
        Route::get('/','DeliveryController@getListLG');

        Route::get('/add', 'DeliveryController@getAdd_LG');
        Route::post('/add', 'DeliveryController@postAdd_LG');

        Route::get('/edit/{id}','DeliveryController@getEditLG');
        Route::post('/edit/{id}','DeliveryController@postEditLG');

        Route::get('/delete/{id}','DeliveryController@getDeleteLG');

        Route::get('/kehoach', 'DeliveryController@getKeHoach_LG');
        Route::post('/kehoach', 'DeliveryController@postKeHoach_LG');

        Route::get('/view/{id}','DeliveryController@getViewLG');

        Route::get('/reset/{id}','DeliveryController@getResetLG');

        Route::get('/wait/{id}','DeliveryController@getWait_LG');
        Route::get('/confirm/{id}','DeliveryController@getConfirm_LG');
        Route::get('/pay/{id}','DeliveryController@getPay_LG');
        Route::get('/xongdn/{id}','DeliveryController@getXongDN_LG');
        Route::get('/xongpxk/{id}','DeliveryController@getXongPXK_LG');
        Route::group(['prefix' => 'detailco'], function() {
            Route::get('/{id}','DeliveryController@getDetailCO_LG');

            Route::get('/{id}/add','DeliveryController@getAddCO_LG');
            Route::post('/{id}/add','DeliveryController@postAddCO_LG');

            Route::get('/{id}/edit/{CO_id}','DeliveryController@getEditCO_LG');
            Route::post('/{id}/edit/{CO_id}','DeliveryController@postEditCO_LG');

            Route::get('/{id}/delete/{CO_id}','DeliveryController@getDeleteCO_LG');

            Route::post('/{id}/delivery_import_CO', 'DeliveryController@import_CO')->name('import.CO');

            Route::get('export-delivery/{type}', 'DeliveryController@export_CO')->name('export.CO');

        });
    });

    Route::group(['prefix' => 'guest'], function() {
        Route::get('/','DeliveryController@getList_GU');

        Route::get('/edit/{id}','DeliveryController@getEditLG');
        Route::post('/edit/{id}','DeliveryController@postEditLG');

        Route::get('/delete/{id}','DeliveryController@getDeleteLG');

        Route::get('/kehoach', 'DeliveryController@getKeHoach_LG');
        Route::post('/kehoach', 'DeliveryController@postKeHoach_LG');

        Route::get('/view/{id}','DeliveryController@getView_GU');

        Route::get('/reset/{id}','DeliveryController@getResetLG');

        Route::get('/wait/{id}','DeliveryController@getWait_LG');
        Route::get('/confirm/{id}','DeliveryController@getConfirm_LG');
        Route::get('/pay/{id}','DeliveryController@getPay_LG');
        Route::get('/xongdn/{id}','DeliveryController@getXongDN_LG');
        Route::get('/xongpxk/{id}','DeliveryController@getXongPXK_LG');
        Route::group(['prefix' => 'detailco'], function() {
            Route::get('/{id}','DeliveryController@getDetailCO_LG');

            Route::get('/{id}/add','DeliveryController@getAddCO_LG');
            Route::post('/{id}/add','DeliveryController@postAddCO_LG');

            Route::get('/{id}/edit/{CO_id}','DeliveryController@getEditCO_LG');
            Route::post('/{id}/edit/{CO_id}','DeliveryController@postEditCO_LG');

            Route::get('/{id}/delete/{CO_id}','DeliveryController@getDeleteCO_LG');

            Route::post('/{id}/delivery_import_CO', 'DeliveryController@import_CO')->name('import.CO');

            Route::get('export-delivery/{type}', 'DeliveryController@export_CO')->name('export.CO');

        });
    });

    Route::group(['prefix' => 'giaohang'], function() {
        Route::get('/','DeliveryController@getListGH');

        Route::get('/add', 'DeliveryController@getAddBV');
        Route::post('/add', 'DeliveryController@postAddBV');

        Route::get('/edit/{id}','DeliveryController@getEditGH');
        Route::post('/edit/{id}','DeliveryController@postEditGH');

        Route::get('/delete/{id}','DeliveryController@getDeleteBV');

        Route::get('/detail/{id}', 'DeliveryController@getDetail_GH');

        Route::get('/kehoach', 'DeliveryController@getKeHoach_GH');
        Route::post('/kehoach', 'DeliveryController@postKeHoach_GH');
        //Route::get('/detail/{id}/add', 'DeliveryController@getAddPicture_GH');
        Route::post('/detail/{id}/add', 'DeliveryController@postAddPicture_GH');

        Route::get('/detail/{id}/delete/{picture_id}','DeliveryController@getDeletePicture_GH');

        Route::get('/bdchathang/{id}','DeliveryController@getBatDauChatHang');
        Route::get('/ktchathang/{id}','DeliveryController@getKetThucChatHang');
        Route::get('/hltaixe/{id}','DeliveryController@getHuanLuyenTaiXe');
        Route::get('/bangiaodn/{id}','DeliveryController@getBanGiaoDN');

    });

    Route::group(['prefix' => 'warehouse'], function() {
        Route::get('/','DeliveryController@getList_WH');

        Route::get('/add', 'DeliveryController@getAddBV');
        Route::post('/add', 'DeliveryController@postAddBV');

        Route::get('/edit/{id}','DeliveryController@getEditGH');
        Route::post('/edit/{id}','DeliveryController@postEditGH');

        Route::get('/delete/{id}','DeliveryController@getDeleteBV');
    });

    Route::group(['prefix' => 'interface'], function() {
        Route::group(['prefix' => 'v1'], function() {
            Route::get('/office', 'DeliveryController@getInterface_v1_Office_IF');
            Route::get('/office2', 'DeliveryController@getInterface_v1_Office2_IF');
        });
        Route::get('/','DeliveryController@getList_IF');

        Route::get('/office', 'DeliveryController@getInterface_Office_IF');
        Route::get('/driver', 'DeliveryController@getInterface_Driver_IF');
        
        Route::get('time','AjaxController@getRealTime');
    });

});



//------------------------------------------------------------------
Route::group(['prefix' => 'training'], function() {
    Route::get('/','TrainingController@getList');
});

//========================================================================
//      Dashboard
//========================================================================
Route::group(['prefix' => 'dashboard'], function() {
    Route::group(['prefix' => 'mfg'], function() {
        Route::get('/','DB_Controller@getListBV');

        Route::get('/add', 'DeliveryController@getAddBV');
        Route::post('/add', 'DeliveryController@postAddBV');

        Route::get('/edit/{id}','DeliveryController@getEditBV');
        Route::post('/edit/{id}','DeliveryController@postEditBV');

        Route::get('/delete/{id}','DeliveryController@getDeleteBV');

        Route::get('/in/{id}','DeliveryController@getIn_BV');
        Route::get('/out/{id}','DeliveryController@getOutBV');
    });

    Route::group(['prefix' => 'hr'], function() {
        Route::get('/','DS_HR_Controller@get_List');

        Route::get('/add', 'DS_HR_Controller@get_Add');
        Route::post('/add', 'DS_HR_Controller@post_Add');

        Route::get('/edit/{id}','DS_HR_Controller@get_Edit');
        Route::post('/edit/{id}','DS_HR_Controller@post_Edit');

        Route::get('/delete/{id}','DS_HR_Controller@get_Delete');
    });

    Route::group(['prefix' => 'safety'], function() {
        Route::get('/','DS_Safety_Controller@get_List');

        Route::get('/add', 'DS_Safety_Controller@get_Add');
        Route::post('/add', 'DS_Safety_Controller@post_Add');

        Route::get('/edit/{id}','DS_Safety_Controller@get_Edit');
        Route::post('/edit/{id}','DS_Safety_Controller@post_Edit');

        Route::get('/delete/{id}','DS_Safety_Controller@get_Delete');
    });

    Route::group(['prefix' => 'interface'], function() {
        Route::get('/','DS_Interface_Controller@getInterface1');

    });

});


Route::group(['prefix' => 'Test'], function() {
    Route::get('/', function() {
        return view('v2.member.layout.index');
    });

    Route::get('/delivery', function() {
        return view('v2.member.delivery.list');
    });
});
//========================================================================
//      V2 - Delivery
//========================================================================
Route::group(['prefix' => 'delivery2'], function() {
    Route::get('/', 'DeliveryController@getDanhSach');

    Route::group(['prefix' => 'baove'], function() {
        Route::get('/','Delivery2Controller@getListBV');

        Route::get('/add', 'Delivery2Controller@getAddBV');
        Route::post('/add', 'Delivery2Controller@postAddBV');

        Route::get('/edit/{id}','Delivery2Controller@getEditBV');
        Route::post('/edit/{id}','DeliveryController@postEditBV');

        Route::get('/delete/{id}','DeliveryController@getDeleteBV');

        Route::get('/in/{id}','DeliveryController@getIn_BV');
        Route::get('/out/{id}','DeliveryController@getOutBV');
    });
    Route::group(['prefix' => 'logistic'], function() {
        Route::get('/','Delivery2Controller@getListLG');

        Route::get('/add', 'Delivery2Controller@getAdd_LG');
        Route::post('/add', 'Delivery2Controller@postAdd_LG');

        Route::get('/edit/{id}','Delivery2Controller@getEditLG');
        Route::post('/edit/{id}','Delivery2Controller@postEditLG');

        Route::get('/delete/{id}','Delivery2Controller@getDeleteBV');

        Route::get('/wait/{id}','Delivery2Controller@getWait_LG');
        Route::get('/confirm/{id}','Delivery2Controller@getConfirm_LG');
        Route::get('/pay/{id}','Delivery2Controller@getPay_LG');
        Route::get('/xongdn/{id}','Delivery2Controller@getXongDN_LG');
        Route::get('/xongpxk/{id}','Delivery2Controller@getXongPXK_LG');
        Route::group(['prefix' => 'detailco'], function() {
            Route::get('/{id}','Delivery2Controller@getDetailCO_LG');

            Route::get('/{id}/add','Delivery2Controller@getAddCO_LG');
            Route::post('/{id}/add','DeliveryController@postAddCO_LG');

            Route::get('/{id}/edit/{CO_id}','Delivery2Controller@getEditCO_LG');
            Route::post('/{id}/edit/{CO_id}','Delivery2Controller@postEditCO_LG');

            Route::get('/{id}/delete/{CO_id}','Delivery2Controller@getDetailCO_LG');

            Route::post('/{id}/delivery_import_CO', 'Delivery2Controller@import_CO')->name('import.v2.CO');;

            Route::get('export-delivery/{type}', 'Delivery2Controller@export_CO')->name('export.v2.CO');

        });
    });

    Route::group(['prefix' => 'giaohang'], function() {
        Route::get('/','Delivery2Controller@getListGH');

        Route::get('/add', 'Delivery2Controller@getAddBV');
        Route::post('/add', 'DeliveryController@postAddBV');

        Route::get('/edit/{id}','DeliveryController@getEditGH');
        Route::post('/edit/{id}','DeliveryController@postEditGH');

        Route::get('/delete/{id}','DeliveryController@getDeleteBV');

        Route::get('/detail/{id}', 'DeliveryController@getDetail_GH');
        //Route::get('/detail/{id}/add', 'DeliveryController@getAddPicture_GH');
        Route::post('/detail/{id}/add', 'DeliveryController@postAddPicture_GH');

        Route::get('/detail/{id}/delete/{picture_id}','DeliveryController@getDeletePicture_GH');

        Route::get('/bdchathang/{id}','DeliveryController@getBatDauChatHang');
        Route::get('/ktchathang/{id}','DeliveryController@getKetThucChatHang');
        Route::get('/hltaixe/{id}','DeliveryController@getHuanLuyenTaiXe');
        Route::get('/bangiaodn/{id}','DeliveryController@getBanGiaoDN');

    });

    Route::group(['prefix' => 'warehouse'], function() {
        Route::get('/','DeliveryController@getList_WH');

        Route::get('/add', 'DeliveryController@getAddBV');
        Route::post('/add', 'DeliveryController@postAddBV');

        Route::get('/edit/{id}','DeliveryController@getEditGH');
        Route::post('/edit/{id}','DeliveryController@postEditGH');

        Route::get('/delete/{id}','DeliveryController@getDeleteBV');
    });

    Route::group(['prefix' => 'interface'], function() {
        Route::get('/','DeliveryController@getList_IF');

        Route::get('/office', 'DeliveryController@getInterface_Office_IF');
        Route::get('/driver', 'DeliveryController@getInterface_Driver_IF');
        
        Route::get('time','AjaxController@getRealTime');
    });

    Route::group(['prefix' => 'report'], function() {
        Route::get('/','Delivery2Controller@getList_RP');
        Route::post('/','Delivery2Controller@postList_RP');

        Route::get('export', 'Delivery2Controller@getExport_RP');
        Route::post('export', 'Delivery2Controller@postExport_RP');

        //Route::get('excel','Delivery2Controller@getExportExcel_RP');
        //Route::post('excel', 'Delivery2Controller@postExportExcel_RP');

    });

});

//========================================================================
//      V2 - KPI
//========================================================================
Route::group(['prefix' => 'kpi'], function() {
    Route::get('/', 'DeliveryController@getDanhSach');

    Route::group(['prefix' => 'outsource'], function() {
        Route::get('/','KPIController@getList_OUT');

        Route::get('/edit/{id}','KPIController@getEdit_OUT');
        Route::post('/edit/{id}','KPIController@postEdit_OUT');

        // Route::get('/delete/{id}','DeliveryController@getDeleteBV');
    });

    Route::group(['prefix' => 'safety'], function() {
        Route::get('/','KPIController@getList_SAF');

        Route::get('/edit/{id}','KPIController@getEdit_SAF');
        Route::post('/edit/{id}','KPIController@postEdit_SAF');

        // Route::get('/delete/{id}','DeliveryController@getDeleteBV');
    });

    Route::group(['prefix' => 'production'], function() {
        Route::get('/','KPIController@getList_PROD');

        Route::get('/edit/{id}','KPIController@getEdit_PROD');
        Route::post('/edit/{id}','KPIController@postEdit_PROD');

        // Route::get('/delete/{id}','DeliveryController@getDeleteBV');
    });

    Route::group(['prefix' => 'qc'], function() {
        Route::get('/','KPIController@getList_QC');

        Route::get('/edit/{id}','KPIController@getEdit_QC');
        Route::post('/edit/{id}','KPIController@postEdit_QC');

        Route::get('/delete/{id}','Delivery2Controller@getDeleteBV');

    });

    Route::group(['prefix' => 'maintenance'], function() {
        Route::get('/','KPIController@getList_MAIN');

        Route::get('/edit/{id}','KPIController@getEdit_MAIN');
        Route::post('/edit/{id}','KPIController@postEdit_MAIN');

        //Route::get('/delete/{id}','Delivery2Controller@getDeleteBV');

    });

    Route::group(['prefix' => 'warehouse'], function() {
        Route::get('/','DeliveryController@getList_WH');

        Route::get('/add', 'DeliveryController@getAddBV');
        Route::post('/add', 'DeliveryController@postAddBV');

        Route::get('/edit/{id}','DeliveryController@getEditGH');
        Route::post('/edit/{id}','DeliveryController@postEditGH');

        Route::get('/delete/{id}','DeliveryController@getDeleteBV');
    });

    Route::group(['prefix' => 'interface'], function() {
        Route::get('/','DeliveryController@getList_IF');

        Route::get('/office', 'DeliveryController@getInterface_Office_IF');
        Route::get('/driver', 'DeliveryController@getInterface_Driver_IF');
        
        Route::get('time','AjaxController@getRealTime');
    });

});


//========================================================================
//      V2 - Dashboard 2
//========================================================================
Route::group(['prefix' => 'dashboard2'], function() {
    Route::group(['prefix' => 'mfg'], function() {
        Route::get('/','DB_Controller@getListBV');

        Route::get('/add', 'DeliveryController@getAddBV');
        Route::post('/add', 'DeliveryController@postAddBV');

        Route::get('/edit/{id}','DeliveryController@getEditBV');
        Route::post('/edit/{id}','DeliveryController@postEditBV');

        Route::get('/delete/{id}','DeliveryController@getDeleteBV');

        Route::get('/in/{id}','DeliveryController@getIn_BV');
        Route::get('/out/{id}','DeliveryController@getOutBV');
    });

    Route::group(['prefix' => 'hr'], function() {
        Route::get('/','DS_HR_Controller@get_List_2');

        Route::get('/add', 'DS_HR_Controller@get_Add_2');
        Route::post('/add', 'DS_HR_Controller@post_Add_2');

        Route::get('/edit/{id}','DS_HR_Controller@get_Edit_2');
        Route::post('/edit/{id}','DS_HR_Controller@post_Edit_2');

        Route::get('/delete/{id}','DS_HR_Controller@get_Delete_2');
    });

    Route::group(['prefix' => 'safety'], function() {
        Route::get('/','DS_Safety_Controller@get_List');

        Route::get('/add', 'DS_Safety_Controller@get_Add');
        Route::post('/add', 'DS_Safety_Controller@post_Add');

        Route::get('/edit/{id}','DS_Safety_Controller@get_Edit');
        Route::post('/edit/{id}','DS_Safety_Controller@post_Edit');

        Route::get('/delete/{id}','DS_Safety_Controller@get_Delete');
    });

    Route::group(['prefix' => 'interface'], function() {
        Route::get('/','DS_Interface_Controller@getInterface1');

    });

});
//========================================================================

//========================================================================
//      V2 - MUSIC
//========================================================================
Route::group(['prefix' => 'music'], function() {
    Route::get('/', 'MusicController@getList_Info');

    Route::get('add','MusicController@getAdd_Info');
    Route::post('add','MusicController@postAdd_Info');

    Route::get('/edit/{id}','MusicController@getEdit_Info');
    Route::post('/edit/{id}','MusicController@postEdit_Info');

    Route::get('/delete/{id}','MusicController@getDelete_Info');

    Route::group(['prefix' => 'activity'], function() {
        Route::get('/', 'MusicController@getList_Acti');

        Route::get('add','MusicController@getAdd_Acti');
        Route::post('add','MusicController@postAdd_Acti');

        Route::get('/edit/{id}','MusicController@getEdit_Acti');
        Route::post('/edit/{id}','MusicController@postEdit_Acti');

        Route::get('/delete/{id}','MusicController@getDelete_Acti');
        });

    Route::group(['prefix' => 'play'], function() {
        Route::get('/', 'MusicController@getList_Play');
    });
});

//========================================================================
//      V2 - OUT MAINTENANCE
//========================================================================
Route::group(['prefix' => 'outmaint'], function() {
        Route::group(['prefix' => 'activity'], function() {
            Route::get('/','OutMaintActivityController@getList');

            Route::get('add','OutMaintActivityController@getAdd');
            Route::post('add','OutMaintActivityController@postAdd');

            Route::get('edit/{id}','OutMaintActivityController@getEdit');
            Route::post('edit/{id}','OutMaintActivityController@postEdit');
        });

        Route::group(['prefix' => 'export'], function() {
            Route::get('/','OutMaintActivityController@getExportExcel1');
            Route::post('/','OutMaintActivityController@postExportExcel1');
        });
});
//========================================================================
//      V2 - PROCUREMENT
//========================================================================
Route::group(['prefix' => 'procurement'], function() {

    Route::group(['prefix' => 'transport'], function() {
        Route::get('/', 'ProcurementController@getList_Trans');

        Route::get('add','ProcurementController@getAdd_Trans');
        Route::post('add','ProcurementController@postAdd_Trans');

        Route::get('/edit/{id}','ProcurementController@getEdit_Trans');
        Route::post('/edit/{id}','ProcurementController@postEdit_Trans');

        Route::post('/importTransport/', 'ProcurementController@importTransport')->name('import.Trans');
        Route::get('/exportTransport/{type}', 'ProcurementController@exportTransport')->name('export.Trans');
        
        Route::get('/delete/{id}','ProcurementController@getDelete_Trans');
    });

    Route::group(['prefix' => 'product'], function() {
        Route::get('/', 'ProcurementController@getList_Prod');

        Route::get('add','ProcurementController@getAdd_Prod');
        Route::post('add','ProcurementController@postAdd_Prod');

        Route::get('/edit/{id}','ProcurementController@getEdit_Prod');
        Route::post('/edit/{id}','ProcurementController@postEdit_Prod');

        // Route::get('/delete/{id}','MusicController@getDelete_Acti');
    });

    Route::group(['prefix' => 'estimatedprice'], function() {
        Route::get('/', 'ProcurementController@getList_Price');

        Route::get('add','ProcurementController@getAdd_Price');
        Route::post('add','ProcurementController@postAdd_Price');

        Route::get('/edit/{id}','ProcurementController@getEdit_Price');
        Route::post('/edit/{id}','ProcurementController@postEdit_Price');
        
        // Route::get('/delete/{id}','MusicController@getDelete_Acti');
    });

    Route::group(['prefix' => 'activity'], function() {
        Route::get('/', 'ProcurementController@getList_Acti');

        Route::get('firstcheck','ProcurementController@getFirstCheck_Acti');
        Route::post('firstcheck','ProcurementController@postFirstCheck_Acti');

        Route::get('add','ProcurementController@getAdd_Acti');
        Route::post('add','ProcurementController@postAdd_Acti');

        Route::post('review','ProcurementController@postReview_Acti');

        // Route::get('/edit/{id}','ProcurementController@getEdit_Acti');
        // Route::post('/edit/{id}','ProcurementController@postEdit_Acti');
        
        // Route::get('/delete/{id}','MusicController@getDelete_Acti');
    });

    Route::group(['prefix' => 'review'], function() {
        Route::get('/', 'ProcurementController@getList_Review');
        Route::get('/ad', 'ProcurementController@getListAd_Review');
        Route::get('/history', 'ProcurementController@getListHistory_Review');

        Route::get('/edit/{id}','ProcurementController@getEdit_Review');
        Route::post('/edit/{id}','ProcurementController@postEdit_Review');

        Route::get('/confirm/{id}','ProcurementController@getConfirm_Review');
        Route::post('/confirm/{id}','ProcurementController@postConfirm_Review');

        Route::post('/noagree/{id}','ProcurementController@postNoAgree_Review');

        Route::get('/export/{id}','ProcurementController@getExportPDF_Review');        
    });

});