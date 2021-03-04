import React from 'react';
import { BrowserRouter as Router, Switch, Route } from 'react-router-dom';
import FirstPage from './components/Pages/FirstPage';
import GlobalStyle from './globalStyles';
import CourseListPage from './components/Pages/CourseListPage';

function App() {
  return (
    <>
      <GlobalStyle />
      <Router>
        <Switch>
          <Route path='/' exact component={FirstPage}/>
          <Route path='/courselist' exact component={CourseListPage}/>
        </Switch>
      </Router>
    </>

  );
}

export default App;