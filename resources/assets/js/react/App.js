import React from 'react';
import { BrowserRouter as Router, Switch, Route } from 'react-router-dom';
import FirstPage from './components/Pages/FirstPage';
import GlobalStyle from './globalStyles';
import CourseListPage from './components/Pages/CourseListPage';
import AboutUsPage from './components/Pages/AboutUsPage';
import UserPage from './components/Pages/UserPage'

function App() {
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

export default App;