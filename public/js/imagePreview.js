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

/***/ "./resources/assets/js/imagePreview.js":
/*!*********************************************!*\
  !*** ./resources/assets/js/imagePreview.js ***!
  \*********************************************/
/***/ (() => {

eval("// Get media after selecting the picture\ndocument.getElementById(\"images\").onchange = function () {\n  var reader = new FileReader();\n\n  reader.onload = function (e) {\n    // get loaded data and render thumbnail.\n    var img = document.getElementById(\"picture\");\n    img.src = e.target.result; // Image input style\n\n    document.getElementById(\"images\").style.marginBottom = \"10px\"; // Hidden input\n\n    document.getElementById(\"hidden_image\").value = e.target.result;\n  }; // read the image file as a data URL.\n\n\n  reader.readAsDataURL(this.files[0]);\n};//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly9TYXJhUmFqYWJpLy4vcmVzb3VyY2VzL2Fzc2V0cy9qcy9pbWFnZVByZXZpZXcuanM/ZTE1YiJdLCJuYW1lcyI6WyJkb2N1bWVudCIsImdldEVsZW1lbnRCeUlkIiwib25jaGFuZ2UiLCJyZWFkZXIiLCJGaWxlUmVhZGVyIiwib25sb2FkIiwiZSIsImltZyIsInNyYyIsInRhcmdldCIsInJlc3VsdCIsInN0eWxlIiwibWFyZ2luQm90dG9tIiwidmFsdWUiLCJyZWFkQXNEYXRhVVJMIiwiZmlsZXMiXSwibWFwcGluZ3MiOiJBQUFBO0FBQ0FBLFFBQVEsQ0FBQ0MsY0FBVCxDQUF3QixRQUF4QixFQUFrQ0MsUUFBbEMsR0FBNkMsWUFBWTtBQUN2RCxNQUFJQyxNQUFNLEdBQUcsSUFBSUMsVUFBSixFQUFiOztBQUNBRCxFQUFBQSxNQUFNLENBQUNFLE1BQVAsR0FBZ0IsVUFBVUMsQ0FBVixFQUFhO0FBQzNCO0FBQ0EsUUFBSUMsR0FBRyxHQUFHUCxRQUFRLENBQUNDLGNBQVQsQ0FBd0IsU0FBeEIsQ0FBVjtBQUNBTSxJQUFBQSxHQUFHLENBQUNDLEdBQUosR0FBVUYsQ0FBQyxDQUFDRyxNQUFGLENBQVNDLE1BQW5CLENBSDJCLENBSTNCOztBQUNBVixJQUFBQSxRQUFRLENBQUNDLGNBQVQsQ0FBd0IsUUFBeEIsRUFBa0NVLEtBQWxDLENBQXdDQyxZQUF4QyxHQUF1RCxNQUF2RCxDQUwyQixDQU0zQjs7QUFDQVosSUFBQUEsUUFBUSxDQUFDQyxjQUFULENBQXdCLGNBQXhCLEVBQXdDWSxLQUF4QyxHQUFnRFAsQ0FBQyxDQUFDRyxNQUFGLENBQVNDLE1BQXpEO0FBQ0QsR0FSRCxDQUZ1RCxDQVd2RDs7O0FBQ0FQLEVBQUFBLE1BQU0sQ0FBQ1csYUFBUCxDQUFxQixLQUFLQyxLQUFMLENBQVcsQ0FBWCxDQUFyQjtBQUNELENBYkQiLCJzb3VyY2VzQ29udGVudCI6WyIvLyBHZXQgbWVkaWEgYWZ0ZXIgc2VsZWN0aW5nIHRoZSBwaWN0dXJlXG5kb2N1bWVudC5nZXRFbGVtZW50QnlJZChcImltYWdlc1wiKS5vbmNoYW5nZSA9IGZ1bmN0aW9uICgpIHtcbiAgdmFyIHJlYWRlciA9IG5ldyBGaWxlUmVhZGVyKCk7XG4gIHJlYWRlci5vbmxvYWQgPSBmdW5jdGlvbiAoZSkge1xuICAgIC8vIGdldCBsb2FkZWQgZGF0YSBhbmQgcmVuZGVyIHRodW1ibmFpbC5cbiAgICB2YXIgaW1nID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJwaWN0dXJlXCIpO1xuICAgIGltZy5zcmMgPSBlLnRhcmdldC5yZXN1bHQ7XG4gICAgLy8gSW1hZ2UgaW5wdXQgc3R5bGVcbiAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcImltYWdlc1wiKS5zdHlsZS5tYXJnaW5Cb3R0b20gPSBcIjEwcHhcIjsgXG4gICAgLy8gSGlkZGVuIGlucHV0XG4gICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJoaWRkZW5faW1hZ2VcIikudmFsdWUgPSBlLnRhcmdldC5yZXN1bHQ7XG4gIH07XG4gIC8vIHJlYWQgdGhlIGltYWdlIGZpbGUgYXMgYSBkYXRhIFVSTC5cbiAgcmVhZGVyLnJlYWRBc0RhdGFVUkwodGhpcy5maWxlc1swXSk7XG59OyJdLCJmaWxlIjoiLi9yZXNvdXJjZXMvYXNzZXRzL2pzL2ltYWdlUHJldmlldy5qcy5qcyIsInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/assets/js/imagePreview.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/assets/js/imagePreview.js"]();
/******/ 	
/******/ })()
;