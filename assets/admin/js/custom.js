/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 6);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/custom.js":
/*!********************************!*\
  !*** ./resources/js/custom.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  $('.data_table').DataTable({
    dom: 'Bfrtip',
    responsive: true,
    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
    order: [0, "desc"],
    buttons: [{
      extend: 'pdf',
      text: '<i class="la la-file-export" data-toggle="popover" data-content="Enregistrer la liste en PDF." data-trigger="hover" data-original-title="PDF" />',
      footer: true,
      exportOptions: {
        columns: [0, 1, 2, 3, 4, 5]
      }
    }, {
      extend: 'excel',
      text: '<i class="la la-file-excel" data-toggle="popover" data-content="Enregistrer la liste sur Excel." data-trigger="hover" data-original-title="Excel" />',
      footer: true,
      exportOptions: {
        columns: [0, 1, 2, 3, 4, 5]
      }
    }]
  });
});
$(function ($) {
  "use strict";

  var main_url = $('#main_url').val(); //color picker with addon

  $('.my-colorpicker2').colorpicker();
  $('.my-colorpicker2').on('colorpickerChange', function (event) {
    $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
  }); // active alert js

  $('.alert').alert(); // Bootstrap Toggle js

  $(function () {
    $("input[data-bootstrap-switch]").each(function () {
      $(this).bootstrapSwitch({
        state: $(this).is(':checked')
      }).trigger('change');
    });
  }); // Summernote

  $('.summernote').summernote(); //Initialize Select2 Elements

  $('.select2bs4').select2({
    theme: 'bootstrap4'
  }); // Start Date

  $('.month-year').datetimepicker({
    format: 'MM/YYYY'
  }); // Language filter

  $('#languageSelect').on('change', function () {
    var languageUrl = $(this).attr('data');
    var languageVal = $(this).val();
    languageUrl = languageUrl + languageVal;
    window.location.href = languageUrl;
  });
  $('.languageSelect').on('change', function () {
    var languageUrl = $(this).attr('data');
    var languageVal = $(this).val();
    languageUrl = languageUrl + languageVal;
    window.location.href = languageUrl;
  }); // Active tooltip

  $('[data-toggle="tooltip"]').tooltip(); // Package  order view Ajax modal

  $('.package_order_view').on('click', function (event) {
    event.preventDefault();
    var id = $(this).attr('data-id');
    $.ajax({
      url: main_url + "/admin/package/view-order/" + id,
      type: "GET",
      dataType: "json",
      success: function success(data) {
        $('#fname').text(data.order.user.name);
        $('#username').text(data.order.user.username);
        $('#email').text(data.order.user.email);
        $('#phone').text(data.order.user.phone);
        $('#address').text(data.order.user.address);
        $('#country').text(data.order.user.country);
        $('#city').text(data.order.user.city);
        $('#packname').text(data.order["package"].name);
        $('#packspeed').text(data.order["package"].speed);
        $('#packprice').text(data.order["package"].price);
        $('#packtime').text(data.order["package"].time);
        $('#packfeature').text(data.order["package"].feature);
        $('#currency_sign').text(data.order.currency_sign);
        $('#method').text(data.order.method);
        $('#attendance_id').text(data.order.attendance_id);
        $('#txn_id').text(data.order.txn_id);
        var status = $('#status').empty();

        if (data.order.status == 0) {
          $('#status').append("<span class=\"badge badge-info\">Pending</span>");
        } else if (data.order.status == 1) {
          $('#status').append("<span class=\"badge badge-primary\">In Progress</span>");
        } else if (data.order.status == 2) {
          $('#status').append("<span class=\"badge badge-success\">Completed</span>");
        }
      }
    });
  }); // Billpay view Ajax modal

  $('.billpay_view').on('click', function (event) {
    event.preventDefault();
    var id = $(this).attr('data-id');
    $.ajax({
      url: main_url + "/admin/bill-pay/view/" + id,
      type: "GET",
      dataType: "json",
      success: function success(data) {
        $('#name').text(data.bill.user.name);
        $('#username').text(data.bill.user.username);
        $('#email').text(data.bill.user.email);
        $('#phone').text(data.bill.user.phone);
        $('#address').text(data.bill.user.address);
        $('#country').text(data.bill.user.country);
        $('#city').text(data.bill.user.city);
        $('#packname').text(data.bill["package"].name);
        $('#packspeed').text(data.bill["package"].speed);
        $('#packprice').text(data.bill["package"].price);
        $('#packtime').text(data.bill["package"].time);
        $('#paydate').text(data.bill.fulldate);
        $('#currency_sign').text(data.bill.currency_sign);
        $('#method').text(data.bill.method);
        $('#attendance_id').text(data.bill.attendance_id);
        $('#txn_id').text(data.bill.txn_id);
      }
    });
  }); // Update Package order Status Ajax modal

  $('.package_order_status').on('click', function (event) {
    event.preventDefault();
    var id = $(this).attr('data-id');
    $.ajax({
      url: main_url + "/admin/package/order-edit-status/" + id,
      type: "GET",
      dataType: "json",
      success: function success(data) {
        $('#update_package_status').attr('action', main_url + "/admin/package/order-update-status/" + data.order.id);
        $('#status_orderid').attr('value', data.order.id);
        var status = $('#status-wrape select').empty();
        var pending = '';
        var progress = '';
        var compleated = '';

        if (data.order.status == 0) {
          var pending = 'selected';
        } else if (data.order.status == 1) {
          var progress = 'selected';
        } else if (data.order.status == 2) {
          var compleated = 'selected';
        }

        var options = '<option value="0" ' + pending + '>Pending</option>' + '<option value="1" ' + progress + '>In Progress</option>' + '<option value="2" ' + compleated + '>Completed</option>';
        $('#status-wrape select').append(options);
      }
    });
  }); //  Blog Ajax Category 

  $('#blog_lan').on('change', function (event) {
    event.preventDefault();
    var lang_id = $(this).val();

    if (lang_id) {
      $.ajax({
        url: main_url + "/admin/blog/get/categoty/" + lang_id,
        type: "GET",
        contentType: false,
        processData: false,
        data: {},
        success: function success(data) {
          $('#bcategory_id').empty();
          $('#bcategory_id').html(data);
        }
      });
    } else {
      alert('danger');
    }
  });
  $(document).on("click", "#delete", function (e) {
    var _this = this;

    e.preventDefault();
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'No, cancel!',
      reverseButtons: true
    }).then(function (result) {
      if (result.value) {
        $(_this).parent("#deleteform").submit();
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        Swal.fire('Cancelled', 'Your file is safe :)', 'error');
      }
    });
  });
  /* ======================================
  Bootstrap Datepicker Start
  ========================================= */
  // Start Date

  $('.datepicker').datetimepicker({
    format: 'MM/YYYY'
  }); // From Date Year Select

  $("#from_date").datetimepicker({
    format: 'YYYY'
  }); // Date To Year Select

  $("#date_to").datetimepicker({
    format: 'YYYY'
  }); // Toggle Date to Field

  $('#date_check').on('change', function () {
    if ($('#date_check').is(':checked')) {
      $("input[name='date_to']").val('');
      $('#date_to_grup').hide();
    } else {
      $('#date_to_grup').show();
    }
  });

  if ($('#date_check').is(':checked')) {
    $('#date_to_grup').hide();
  }
  /* ======================================
  Bootstrap Datepicker End
  ========================================= */

  /* ======================================
  Bs Cistom Input Start
  ========================================= */


  bsCustomFileInput.init();
  /* =======================================
  Bs Cistom Input End
  ========================================== */

  /* ======================================
  IMAGE UPLOADING Start
  ========================================= */

  $(".up-img").on("change", function () {
    var imgpath = $(this).parent().parent().find('.show-img');
    var file = $(this);
    readURL(this, imgpath);
  });

  function readURL(input, imgpath) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        imgpath.attr('src', e.target.result);
      };

      reader.readAsDataURL(input.files[0]);
    }
  }
  /* ========================================
  IMAGE UPLOADING End 
  =========================================== */


  if (document.body.dataset.notification == undefined) {
    return false;
  } else {
    var data = JSON.parse(document.body.dataset.notificationMessage);
    var msg = data.messege;
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: function didOpen(toast) {
        toast.addEventListener('mouseenter', Swal.stopTimer);
        toast.addEventListener('mouseleave', Swal.resumeTimer);
      }
    });

    switch (data.alert) {
      case 'info':
        Toast.fire({
          icon: 'info',
          title: msg
        });
        break;

      case 'success':
        Toast.fire({
          icon: 'success',
          title: msg
        });
        break;

      case 'warning':
        Toast.fire({
          icon: 'warning',
          title: msg
        });
        break;

      case 'error':
        Toast.fire({
          icon: 'error',
          title: msg
        });
        break;
    }
  }

  ;
}); // Iconpicker Icon Submit Javascript Code

function store(e) {
  e.preventDefault();
  $("#inputIcon").val($(".biconpicker").find('i').attr('class'));
  document.getElementById('slink').submit();
}

/***/ }),

/***/ 6:
/*!**************************************!*\
  !*** multi ./resources/js/custom.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! c:\laragon\www\chawad\core\resources\js\custom.js */"./resources/js/custom.js");


/***/ })

/******/ });