/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/assets/js/commentSubmission.js":
/*!**************************************************!*\
  !*** ./resources/assets/js/commentSubmission.js ***!
  \**************************************************/
/***/ (() => {

eval("// Submission\nwindow.showSubmissionModal = function showSubmissionModal(id) {\n  $('#form_output').html('');\n  $('#submissionModal').modal('show');\n  $('#submission').val(id);\n}; // Store or Update\n\n\n$(\"#submission\").click(function (e) {\n  e.preventDefault();\n  $.ajax({\n    method: \"POST\",\n    url: \"/courseComment/submit/\",\n    data: {\n      submission: $(this).val()\n    },\n    success: function success(data) {\n      $('#form_output').html(data.success);\n    }\n  });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly9zYXJhUmFqYWJpLy4vcmVzb3VyY2VzL2Fzc2V0cy9qcy9jb21tZW50U3VibWlzc2lvbi5qcz8yMTc1Il0sIm5hbWVzIjpbIndpbmRvdyIsInNob3dTdWJtaXNzaW9uTW9kYWwiLCJpZCIsIiQiLCJodG1sIiwibW9kYWwiLCJ2YWwiLCJjbGljayIsImUiLCJwcmV2ZW50RGVmYXVsdCIsImFqYXgiLCJtZXRob2QiLCJ1cmwiLCJkYXRhIiwic3VibWlzc2lvbiIsInN1Y2Nlc3MiXSwibWFwcGluZ3MiOiJBQUFBO0FBQ0FBLE1BQU0sQ0FBQ0MsbUJBQVAsR0FBNkIsU0FBU0EsbUJBQVQsQ0FBNkJDLEVBQTdCLEVBQWlDO0FBQzVEQyxFQUFBQSxDQUFDLENBQUMsY0FBRCxDQUFELENBQWtCQyxJQUFsQixDQUF1QixFQUF2QjtBQUNBRCxFQUFBQSxDQUFDLENBQUMsa0JBQUQsQ0FBRCxDQUFzQkUsS0FBdEIsQ0FBNEIsTUFBNUI7QUFDQUYsRUFBQUEsQ0FBQyxDQUFDLGFBQUQsQ0FBRCxDQUFpQkcsR0FBakIsQ0FBcUJKLEVBQXJCO0FBQ0QsQ0FKRCxDLENBTUE7OztBQUNBQyxDQUFDLENBQUMsYUFBRCxDQUFELENBQWlCSSxLQUFqQixDQUF1QixVQUFTQyxDQUFULEVBQVk7QUFDakNBLEVBQUFBLENBQUMsQ0FBQ0MsY0FBRjtBQUNBTixFQUFBQSxDQUFDLENBQUNPLElBQUYsQ0FBTztBQUNMQyxJQUFBQSxNQUFNLEVBQUUsTUFESDtBQUVMQyxJQUFBQSxHQUFHLEVBQUUsd0JBRkE7QUFHTEMsSUFBQUEsSUFBSSxFQUFFO0FBQ0pDLE1BQUFBLFVBQVUsRUFBRVgsQ0FBQyxDQUFDLElBQUQsQ0FBRCxDQUFRRyxHQUFSO0FBRFIsS0FIRDtBQU1MUyxJQUFBQSxPQUFPLEVBQUUsaUJBQVNGLElBQVQsRUFBZTtBQUN0QlYsTUFBQUEsQ0FBQyxDQUFDLGNBQUQsQ0FBRCxDQUFrQkMsSUFBbEIsQ0FBdUJTLElBQUksQ0FBQ0UsT0FBNUI7QUFDRDtBQVJJLEdBQVA7QUFVRCxDQVpEIiwic291cmNlc0NvbnRlbnQiOlsiLy8gU3VibWlzc2lvblxud2luZG93LnNob3dTdWJtaXNzaW9uTW9kYWwgPSBmdW5jdGlvbiBzaG93U3VibWlzc2lvbk1vZGFsKGlkKSB7XG4gICQoJyNmb3JtX291dHB1dCcpLmh0bWwoJycpO1xuICAkKCcjc3VibWlzc2lvbk1vZGFsJykubW9kYWwoJ3Nob3cnKTtcbiAgJCgnI3N1Ym1pc3Npb24nKS52YWwoaWQpO1xufVxuXG4vLyBTdG9yZSBvciBVcGRhdGVcbiQoXCIjc3VibWlzc2lvblwiKS5jbGljayhmdW5jdGlvbihlKSB7XG4gIGUucHJldmVudERlZmF1bHQoKTtcbiAgJC5hamF4KHtcbiAgICBtZXRob2Q6IFwiUE9TVFwiLFxuICAgIHVybDogXCIvY291cnNlQ29tbWVudC9zdWJtaXQvXCIsXG4gICAgZGF0YTogeyBcbiAgICAgIHN1Ym1pc3Npb246ICQodGhpcykudmFsKCksXG4gICAgfSxcbiAgICBzdWNjZXNzOiBmdW5jdGlvbihkYXRhKSB7XG4gICAgICAkKCcjZm9ybV9vdXRwdXQnKS5odG1sKGRhdGEuc3VjY2Vzcyk7XG4gICAgfVxuICB9KTtcbn0pO1xuICAiXSwiZmlsZSI6Ii4vcmVzb3VyY2VzL2Fzc2V0cy9qcy9jb21tZW50U3VibWlzc2lvbi5qcy5qcyIsInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/assets/js/commentSubmission.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/assets/js/commentSubmission.js"]();
/******/ 	
/******/ })()
;