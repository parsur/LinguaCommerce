import React from 'react';
import { BrowserRouter as Router, Switch, Route } from 'react-router-dom';
import GlobalStyle from './globalStyles';
import CourseListPage from './components/Pages/CourseListPage';
import AboutUsPage from './components/Pages/AboutUsPage';
import UserPage from './components/Pages/UserPage';
import Consultante from './components/Pages/Consultante';
import WhymePage from './components/Pages/WhymePage';
import CourseDetailsPage from './components/Pages/CourseDetails';
import ArticleDetails from './components/Pages/ArticleDetails';
import ArticleLists from './components/Pages/ArticleListPage';
import Login from './components/Login';
import Signup from './components/Signup';
import Home from './components/Home';
import Cart from './components/Cart';

function App() {

    return(
    <>
 <GlobalStyle />
      <Router>
        <Switch>
          <Route path='/' exact component={Home}/>
          <Route path='/courselist' exact component={CourseListPage}/>
          <Route path='/aboutus' exact component={AboutUsPage}/>
          <Route path='/userpage' exact component={UserPage}/>
          <Route path='/consultante' exact component={Consultante}/>
          <Route path='/whyme' exact component={WhymePage}/>
          <Route path='/course/:id' exact component={CourseDetailsPage}/>
          <Route path='/article/:id' exact component={ArticleDetails}/>
          <Route path='/articlelists' exact component={ArticleLists}/>
          <Route path='/login' exact component={Login}/>
          <Route path='/register' exact component={Signup}/>
          <Route path='/cart' exact component={Cart}/>
        </Switch>
      </Router>
    </>
    );
}; 
export default App;