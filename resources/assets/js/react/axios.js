import axios from "axios";

const token = "parsur";

export default function apiAxios(route) {
     // here is fetch id. change it if you want
     return axios.get("http://sararajabi.com/api/v1" + route, {
          headers: {
               'api_key': `${token}`,
               'Authorization': `Bearer ${localStorage.getItem('token')}`,
          }
     })
}