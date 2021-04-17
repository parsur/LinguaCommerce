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

eval("// Submission\nwindow.showSubmissionModal = function showSubmissionModal(id) {\n  $('#form_output').html('');\n  $('#submissionModal').modal('show');\n  $('#submission').val(id);\n}; // Store or Update\n\n\n$(\"#submission\").click(function (e) {\n  e.preventDefault();\n  $.ajax({\n    type: \"POST\",\n    url: \"/courseComment/submission\",\n    data: {\n      submission: $(this).val()\n    },\n    success: function success(data) {\n      $('#form_output').html(data.success);\n    }\n  });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly9TYXJhUmFqYWJpLy4vcmVzb3VyY2VzL2Fzc2V0cy9qcy9jb21tZW50U3VibWlzc2lvbi5qcz8yMTc1Il0sIm5hbWVzIjpbIndpbmRvdyIsInNob3dTdWJtaXNzaW9uTW9kYWwiLCJpZCIsIiQiLCJodG1sIiwibW9kYWwiLCJ2YWwiLCJjbGljayIsImUiLCJwcmV2ZW50RGVmYXVsdCIsImFqYXgiLCJ0eXBlIiwidXJsIiwiZGF0YSIsInN1Ym1pc3Npb24iLCJzdWNjZXNzIl0sIm1hcHBpbmdzIjoiQUFBQTtBQUNBQSxNQUFNLENBQUNDLG1CQUFQLEdBQTZCLFNBQVNBLG1CQUFULENBQTZCQyxFQUE3QixFQUFpQztBQUM1REMsRUFBQUEsQ0FBQyxDQUFDLGNBQUQsQ0FBRCxDQUFrQkMsSUFBbEIsQ0FBdUIsRUFBdkI7QUFDQUQsRUFBQUEsQ0FBQyxDQUFDLGtCQUFELENBQUQsQ0FBc0JFLEtBQXRCLENBQTRCLE1BQTVCO0FBQ0FGLEVBQUFBLENBQUMsQ0FBQyxhQUFELENBQUQsQ0FBaUJHLEdBQWpCLENBQXFCSixFQUFyQjtBQUNELENBSkQsQyxDQU1BOzs7QUFDQUMsQ0FBQyxDQUFDLGFBQUQsQ0FBRCxDQUFpQkksS0FBakIsQ0FBdUIsVUFBU0MsQ0FBVCxFQUFZO0FBQ2pDQSxFQUFBQSxDQUFDLENBQUNDLGNBQUY7QUFDQU4sRUFBQUEsQ0FBQyxDQUFDTyxJQUFGLENBQU87QUFDTEMsSUFBQUEsSUFBSSxFQUFFLE1BREQ7QUFFTEMsSUFBQUEsR0FBRyxFQUFFLDJCQUZBO0FBR0xDLElBQUFBLElBQUksRUFBRTtBQUNKQyxNQUFBQSxVQUFVLEVBQUVYLENBQUMsQ0FBQyxJQUFELENBQUQsQ0FBUUcsR0FBUjtBQURSLEtBSEQ7QUFNTFMsSUFBQUEsT0FBTyxFQUFFLGlCQUFTRixJQUFULEVBQWU7QUFDdEJWLE1BQUFBLENBQUMsQ0FBQyxjQUFELENBQUQsQ0FBa0JDLElBQWxCLENBQXVCUyxJQUFJLENBQUNFLE9BQTVCO0FBQ0Q7QUFSSSxHQUFQO0FBVUQsQ0FaRCIsInNvdXJjZXNDb250ZW50IjpbIi8vIFN1Ym1pc3Npb25cbndpbmRvdy5zaG93U3VibWlzc2lvbk1vZGFsID0gZnVuY3Rpb24gc2hvd1N1Ym1pc3Npb25Nb2RhbChpZCkge1xuICAkKCcjZm9ybV9vdXRwdXQnKS5odG1sKCcnKTtcbiAgJCgnI3N1Ym1pc3Npb25Nb2RhbCcpLm1vZGFsKCdzaG93Jyk7XG4gICQoJyNzdWJtaXNzaW9uJykudmFsKGlkKTtcbn1cblxuLy8gU3RvcmUgb3IgVXBkYXRlXG4kKFwiI3N1Ym1pc3Npb25cIikuY2xpY2soZnVuY3Rpb24oZSkge1xuICBlLnByZXZlbnREZWZhdWx0KCk7XG4gICQuYWpheCh7XG4gICAgdHlwZTogXCJQT1NUXCIsXG4gICAgdXJsOiBcIi9jb3Vyc2VDb21tZW50L3N1Ym1pc3Npb25cIixcbiAgICBkYXRhOiB7IFxuICAgICAgc3VibWlzc2lvbjogJCh0aGlzKS52YWwoKSxcbiAgICB9LFxuICAgIHN1Y2Nlc3M6IGZ1bmN0aW9uKGRhdGEpIHtcbiAgICAgICQoJyNmb3JtX291dHB1dCcpLmh0bWwoZGF0YS5zdWNjZXNzKTtcbiAgICB9XG4gIH0pO1xufSk7XG4gICJdLCJmaWxlIjoiLi9yZXNvdXJjZXMvYXNzZXRzL2pzL2NvbW1lbnRTdWJtaXNzaW9uLmpzLmpzIiwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/assets/js/commentSubmission.js\n");

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ "use strict";
/******/ 
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ var __webpack_exports__ = (__webpack_exec__("./resources/assets/js/commentSubmission.js"));
/******/ }
]);