import React from 'react';
import { BrowserRouter as Router, Switch, Route } from 'react-router-dom';
import FirstPage from './react/Pages/FirstPage';
import GlobalStyle from './globalStyles';
import CourseListPage from './react/Pages/CourseListPage';
import AboutUsPage from './react/Pages/AboutUsPage';
import UserPage from './react/Pages/UserPage'

function ReactApp() {
  return (
    <>
      <GlobalStyle />
      <Router>
        <Switch>
          <Route path='/' exact component={FirstPage}/>
          <Route path='/courselist' exact component={CourseListPage}/>
          <Route path='/aboutus' exact component={AboutUsPage}/>
          <Route path='/userpage' exact component={UserPage}/>
        </Switch>
      </Router>
    </>
  );
}

export default ReactApp;