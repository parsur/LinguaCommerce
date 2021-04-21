import axios from "axios";

const token = "parsur";

export default function api(route) {
     // here is fetch id. change it if you want
     return fetch("http://sararajabi.com/" + route, {
          headers: {
               'api_key': `${token}`
          }
     })
          .then(res => res.json())
}

// export default function api(route) {
//      // here is fetch id. change it if you want
//      return fetch("http://sararajabi.com/" + route, {
//           headers: {
//                'api_key': `${token}`
//           }
//      })
//           .then(res => res.json())
// }

// how can i use two functions here?