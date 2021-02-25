import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import { BrowserRouter, Route, Switch } from 'react-router-dom'
import coursesList from './coursesList'

class App extends Component {
    render () {
        return (
            <BrowserRouter>
            <div>
              <Switch>
                <Route exact path='/' component={coursesList} />
              </Switch>
            </div>
          </BrowserRouter>
        )
    }
}

if(document.getElementById('app')) {
  ReactDOM.render(<App />, document.getElementById('app'))
}
