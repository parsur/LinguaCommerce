/******/ (() => { // webpackBootstrap
/*!****************************************!*\
  !*** ./resources/js/requestHandler.js ***!
  \****************************************/
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var requestHandler = /*#__PURE__*/function () {
  // Constructor
  function requestHandler(formId, url) {
    _classCallCheck(this, requestHandler);

    // Form Id
    this.formId = formId; // Url

    this.url = url;
  } // modal


  _createClass(requestHandler, [{
    key: "modal",
    value: function modal() {
      $('#formModal').modal('show');
      $(this.formId)[0].reset();
      $('#form_output').html('');
    } // Insert

  }, {
    key: "insert",
    value: function insert(dt) {
      // Ajax Setup
      $.ajaxSetup({
        processing: true,
        dataType: "json"
      }); // Form And Url

      var form = this.formId;
      var url = this.url; // Store or Update

      $(this.formId).on('submit', function (event) {
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
          url: "/" + url + "/new",
          method: "POST",
          data: form_data,
          success: function success(data) {
            $('#form_output').html(data.success);
            $('#button_action').val('insert');
            dt.draw(false);
            $(form)[0].reset();
          },
          error: function error(data) {
            _error(data);
          }
        });
      });
    } // Delete

  }, {
    key: "delete",
    value: function _delete(id) {
      // Id and Url
      var id = id;
      var url = this.url;
      $('#confirmModal').modal('show');
      $('#ok_button').click(function () {
        $.ajax({
          url: "/" + url + "/delete/" + id,
          mathod: "get",
          success: function success(data) {
            $('#confirmModal').modal('hide');
            dt.draw(false);
          }
        });
      });
    }
  }]);

  return requestHandler;
}(); // Error Handler


function _error(data) {
  // Parse To Json
  var data = JSON.parse(data.responseText); // Error

  error_html = '';

  for (var all in data.errors) {
    error_html += '<div class="alert alert-danger">' + data.errors[all] + '</div>';
  }

  $('#form_output').html(error_html);
}
/******/ })()
;