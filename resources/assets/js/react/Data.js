import { AiFillAlert, AiFillAlipayCircle, AiFillCarryOut, AiFillDropboxCircle } from 'react-icons/ai';
import { Block } from './components/Course/CourseElements';

export const mainPageData =
    {
        welcome: 'خوش آمدید به این سایت',
        main: 'فن بیان',
        desc: 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و '
    }

export const userDash = [
  {
    to: '/',
    text: 'حساب کاربری',
    icon: <AiFillAlert />
  },
  {
    to: '/testtwo',
    text: 'سفارش ها',
    icon: <AiFillAlipayCircle />
  },
  {
    to: '/userpage',
    text: 'دیدگاه‌های دوره',
    icon: <AiFillCarryOut />
  },
  {
    to: '/userpage',
    text: 'دیدگاه‌های مقاله',
    icon: <AiFillDropboxCircle />
  }
]

export const courseData = [
  {
    text: "something"
  },
  {
    text: "sduhiw"
  },
  {
    text: "adwrggv"
  },
  {
    text: "asdrgjil"
  },
  {
    text: "sadwwr"
  },
  {
    text: "ololhjk"
  },
  {
    text: "czvvbbv"
  }
]

// where user puts their main data
export const dash = {
  dashboardName: 'Ferox',
  mobileNumber: '۰۹۳۰۶۵۵۶۰۴۲',
  emailAddress: 'example@gmail.com',
  created: '۱۶/۱۲/۹۹',
  edited: '۱۶/۱۲/۹۹'
}

// style for gif backgorund
export const backStyle = {
    
  "particles": {
    "number": {
      "value": 80,
      "density": {
        "enable": true,
        "value_area": 800
      }
    },
    "color": {
      "value": "#000000"
    },
    "shape": {
      "type": "circle",
      "stroke": {
        "width": 3,
        "color": "#2828ff"
      },
      "polygon": {
        "nb_sides": 6
      },
      "image": {
        "src": "img/github.svg",
        "width": 100,
        "height": 100
      }
    },
    "opacity": {
      "value": 0.5,
      "random": true,
      "anim": {
        "enable": false,
        "speed": 1,
        "opacity_min": 0.1,
        "sync": false
      }
    },
    "size": {
      "value": 2,
      "random": true,
      "anim": {
        "enable": false,
        "speed": 30,
        "size_min": 19.980019980019982,
        "sync": false
      }
    },
    "line_linked": {
      "enable": false,
      "distance": 0,
      "color": "#ffffff",
      "opacity": 0.31,
      "width": 1.4204657549380908
    },
    "move": {
      "enable": true,
      "speed": 2,
      "direction": "none",
      "random": false,
      "straight": false,
      "out_mode": "out",
      "bounce": false,
      "attract": {
        "enable": false,
        "rotateX": 600,
        "rotateY": 1200
      }
    }
  },
  "interactivity": {
    "detect_on": "canvas",
    "events": {
      "onhover": {
        "enable": false,
        "mode": "repulse"
      },
      "onclick": {
        "enable": false,
        "mode": "push"
      },
      "resize": true
    },
    "modes": {
      "grab": {
        "distance": 623.3766233766235,
        "line_linked": {
          "opacity": 1
        }
      },
      "bubble": {
        "distance": 443.5564435564435,
        "size": 67.93206793206794,
        "duration": 2.237762237762238,
        "opacity": 8,
        "speed": 3
      },
      "repulse": {
        "distance": 200,
        "duration": 0.4
      },
      "push": {
        "particles_nb": 4
      },
      "remove": {
        "particles_nb": 2
      }
    }
  },
  "retina_detect": true
}

export const backStyleTwo = {
    
  "particles": {
    "number": {
      "value": 80,
      "density": {
        "enable": true,
        "value_area": 800
      }
    },
    "color": {
      "value": "#000000"
    },
    "shape": {
      "type": "circle",
      "stroke": {
        "width": 3,
        "color": "#eee"
      },
      "polygon": {
        "nb_sides": 6
      },
      "image": {
        "src": "img/github.svg",
        "width": 100,
        "height": 100
      }
    },
    "opacity": {
      "value": 0.5,
      "random": true,
      "anim": {
        "enable": false,
        "speed": 1,
        "opacity_min": 0.1,
        "sync": false
      }
    },
    "size": {
      "value": 2,
      "random": true,
      "anim": {
        "enable": false,
        "speed": 30,
        "size_min": 19.980019980019982,
        "sync": false
      }
    },
    "line_linked": {
      "enable": false,
      "distance": 0,
      "color": "#ffffff",
      "opacity": 0.31,
      "width": 1.4204657549380908
    },
    "move": {
      "enable": true,
      "speed": 2,
      "direction": "none",
      "random": false,
      "straight": false,
      "out_mode": "out",
      "bounce": false,
      "attract": {
        "enable": false,
        "rotateX": 600,
        "rotateY": 1200
      }
    }
  },
  "interactivity": {
    "detect_on": "canvas",
    "events": {
      "onhover": {
        "enable": false,
        "mode": "repulse"
      },
      "onclick": {
        "enable": false,
        "mode": "push"
      },
      "resize": true
    },
    "modes": {
      "grab": {
        "distance": 623.3766233766235,
        "line_linked": {
          "opacity": 1
        }
      },
      "bubble": {
        "distance": 443.5564435564435,
        "size": 67.93206793206794,
        "duration": 2.237762237762238,
        "opacity": 8,
        "speed": 3
      },
      "repulse": {
        "distance": 200,
        "duration": 0.4
      },
      "push": {
        "particles_nb": 4
      },
      "remove": {
        "particles_nb": 2
      }
    }
  },
  "retina_detect": true
}

export const gifStyle = {
    width: '100vw',
    height: '100vh',
    position: 'absolute',
    top: '0',
    left: '0'
}

export const gifStyleTwo = {
  width: '100vw',
  height: '100vh',
  position: 'absolute',
  top: '0',
  left: '0',
  marginTop: '80px'
}

//style for gif background ends here