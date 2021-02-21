import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import { BrowserRouter, Route, Switch } from 'react-router-dom'

class App extends Component {
    render () {
        return (
            <div>
                سلام
            </div>
        )
    }
}

ReactDOM.render(<App />, document.getElementById('app'))