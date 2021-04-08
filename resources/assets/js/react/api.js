export default function api(route) {
     // here is fetch id. change it if you want
     return fetch("http://sararajabi.com/" + route)
          .then(res => res.json())
}