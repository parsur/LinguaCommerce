/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
(self["webpackChunkSaraRajabi"] = self["webpackChunkSaraRajabi"] || []).push([["/js/commentSubmission"],{

/***/ "./resources/assets/js/commentSubmission.js":
/*!**************************************************!*\
  !*** ./resources/assets/js/commentSubmission.js ***!
  \**************************************************/
/***/ (() => {

eval("// Submission\nwindow.showSubmissionModal = function showSubmissionModal(id) {\n  $('#form_output').html('');\n  $('#submissionModal').modal('show');\n  $('#submission').val(id);\n}; // Store or Update\n\n\n$(\"#submission\").click(function (e) {\n  e.preventDefault();\n  $.ajax({\n    type: \"POST\",\n    url: \"/courseComment/submission\",\n    data: {\n      submission: $(this).val()\n    },\n    success: function success(data) {\n      $('#form_output').html(data.message);\n    }\n  });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly9TYXJhUmFqYWJpLy4vcmVzb3VyY2VzL2Fzc2V0cy9qcy9jb21tZW50U3VibWlzc2lvbi5qcz8yMTc1Il0sIm5hbWVzIjpbIndpbmRvdyIsInNob3dTdWJtaXNzaW9uTW9kYWwiLCJpZCIsIiQiLCJodG1sIiwibW9kYWwiLCJ2YWwiLCJjbGljayIsImUiLCJwcmV2ZW50RGVmYXVsdCIsImFqYXgiLCJ0eXBlIiwidXJsIiwiZGF0YSIsInN1Ym1pc3Npb24iLCJzdWNjZXNzIiwibWVzc2FnZSJdLCJtYXBwaW5ncyI6IkFBQUE7QUFDQUEsTUFBTSxDQUFDQyxtQkFBUCxHQUE2QixTQUFTQSxtQkFBVCxDQUE2QkMsRUFBN0IsRUFBaUM7QUFDNURDLEVBQUFBLENBQUMsQ0FBQyxjQUFELENBQUQsQ0FBa0JDLElBQWxCLENBQXVCLEVBQXZCO0FBQ0FELEVBQUFBLENBQUMsQ0FBQyxrQkFBRCxDQUFELENBQXNCRSxLQUF0QixDQUE0QixNQUE1QjtBQUNBRixFQUFBQSxDQUFDLENBQUMsYUFBRCxDQUFELENBQWlCRyxHQUFqQixDQUFxQkosRUFBckI7QUFDRCxDQUpELEMsQ0FNQTs7O0FBQ0FDLENBQUMsQ0FBQyxhQUFELENBQUQsQ0FBaUJJLEtBQWpCLENBQXVCLFVBQVNDLENBQVQsRUFBWTtBQUNqQ0EsRUFBQUEsQ0FBQyxDQUFDQyxjQUFGO0FBQ0FOLEVBQUFBLENBQUMsQ0FBQ08sSUFBRixDQUFPO0FBQ0xDLElBQUFBLElBQUksRUFBRSxNQUREO0FBRUxDLElBQUFBLEdBQUcsRUFBRSwyQkFGQTtBQUdMQyxJQUFBQSxJQUFJLEVBQUU7QUFDSkMsTUFBQUEsVUFBVSxFQUFFWCxDQUFDLENBQUMsSUFBRCxDQUFELENBQVFHLEdBQVI7QUFEUixLQUhEO0FBTUxTLElBQUFBLE9BQU8sRUFBRSxpQkFBU0YsSUFBVCxFQUFlO0FBQ3RCVixNQUFBQSxDQUFDLENBQUMsY0FBRCxDQUFELENBQWtCQyxJQUFsQixDQUF1QlMsSUFBSSxDQUFDRyxPQUE1QjtBQUNEO0FBUkksR0FBUDtBQVVELENBWkQiLCJzb3VyY2VzQ29udGVudCI6WyIvLyBTdWJtaXNzaW9uXG53aW5kb3cuc2hvd1N1Ym1pc3Npb25Nb2RhbCA9IGZ1bmN0aW9uIHNob3dTdWJtaXNzaW9uTW9kYWwoaWQpIHtcbiAgJCgnI2Zvcm1fb3V0cHV0JykuaHRtbCgnJyk7XG4gICQoJyNzdWJtaXNzaW9uTW9kYWwnKS5tb2RhbCgnc2hvdycpO1xuICAkKCcjc3VibWlzc2lvbicpLnZhbChpZCk7XG59XG5cbi8vIFN0b3JlIG9yIFVwZGF0ZVxuJChcIiNzdWJtaXNzaW9uXCIpLmNsaWNrKGZ1bmN0aW9uKGUpIHtcbiAgZS5wcmV2ZW50RGVmYXVsdCgpO1xuICAkLmFqYXgoe1xuICAgIHR5cGU6IFwiUE9TVFwiLFxuICAgIHVybDogXCIvY291cnNlQ29tbWVudC9zdWJtaXNzaW9uXCIsXG4gICAgZGF0YTogeyBcbiAgICAgIHN1Ym1pc3Npb246ICQodGhpcykudmFsKCksXG4gICAgfSxcbiAgICBzdWNjZXNzOiBmdW5jdGlvbihkYXRhKSB7XG4gICAgICAkKCcjZm9ybV9vdXRwdXQnKS5odG1sKGRhdGEubWVzc2FnZSk7XG4gICAgfVxuICB9KTtcbn0pO1xuICAiXSwiZmlsZSI6Ii4vcmVzb3VyY2VzL2Fzc2V0cy9qcy9jb21tZW50U3VibWlzc2lvbi5qcy5qcyIsInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/assets/js/commentSubmission.js\n");

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ "use strict";
/******/ 
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ var __webpack_exports__ = (__webpack_exec__("./resources/assets/js/commentSubmission.js"));
/******/ }
]);