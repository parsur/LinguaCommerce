import React from 'react';
import { BrowserRouter as Router, Switch, Route } from 'react-router-dom';
import FirstPage from './components/Pages/FirstPage';

function App() {

  return (
    <div>
      <Router>
        <FirstPage />
        <Switch>
          {/* this is basically how to Route
          <Route path="/services" exact component={Services}/>
              then you add more of these for more routes */}
        </Switch>
      </Router>
    </div>
  );
}

export default App;
