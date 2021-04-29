import React, { useEffect, useState } from 'react';
import{ useParams } from 'react-router-dom';
import {
  Container,
  Top,
  Middle,
  Left,
  Center,
  Sidebar,
  STop,
  SMiddle,
  SBottom,
  Price,
  HR,
  H,
  Category,
  SMLeft,
  SMRight,
  STH,
  STUL, STLI,
  STHR,
  Bottom,
  BLeft,
  BRight,
  SBC,
  Comments,
  MakeNew,
  MNTop,
  MNBottom,
  MNLeft,
  MNRight,
  TextArea,
  MNText,
  NameInput,
  MNSubBottom,
  SubmitComments,
  CommentsH2,
  Comment,
  UserTop,
  UserComment,
  Commenter,
  HiOutlineUserCircles,
  Videos,
  NoComments,
  OthersContainer,
  OTop, OBttom,
  Box, BP, BoxB
} from './CourseDetailsElements';
import './coursedetails.css';
import api from '../../api';
import '@brainhubeu/react-carousel/lib/style.css';
import axios from 'axios';
import Loader from 'react-loader-spinner';
import Particles from 'react-particles-js';
import { backStyleTwo, gifStyleTwo } from '../../Data';
import { Link } from 'react-router-dom';
import axiosApi from '../../axios';

const CourseDetails = () => {
  let { id } = useParams();

  const [course, setCourse] = useState();
  const [desc, setDesc] = useState();
  const [comments, setComments] = useState();
  const [name, setName] = useState("");
  const [newComment, setNewComment] = useState("");
  const [subCategoryName, setSubCategoryName] = useState("");
  const [category, setCategory] = useState({});
  const [isError, setIsError] = useState(false);
  const [succes, setSucces] = useState(false);
  const [videos, setVideos] = useState([]);
  const [images, setImages] = useState([]);

useEffect(() => {
  api(`api/v1/course/details?id=${id}`)
      .then((data) => {
          setCourse(data.course);
          setDesc(data.course.description);
          setComments(data.course.comments);
          setCategory(data.course.category);
          setVideos(data.videos);
          setImages(data.images);
          if(data.course.sub_category === null){
            setSubCategoryName("");
          } else {
            setSubCategoryName(data.course.sub_category.name);
          }
      })
}, []);

function handleStatus(course){
  if(course.statuses.status == 0){
    return "افزودن به سبد خرید"
  } else {
    return "ناموجود"
  }
}

function handleAddCart(course){
  if(course.statuses.status == 0){
    return addCart
  } else {
    return null
  }
}

function noComments(){
  if(comments == 0){
    return <NoComments>اولین کسی باشید که کامنت میگذارید</NoComments>
  }
}

const token = 'parsur';

function addCart(){
  if(course.price === null){
  axiosApi(`/course/download?id=${id}`)
  .then(function (response) {
      setSucces(true);
  })
  .catch(function (error) {
      console.log(error);
      if(error){
        setIsError(true)
      }
  });
  } else {
  axios.post('http://sararajabi.com/api/v1/cart/store', {
      course_id: id
  }, {
      headers: {
        'api_key': `${token}`,
        'Authorization': `Bearer ${localStorage.getItem('token')}`,
      }
    }
  )
  .then(function (response) {
      setSucces(true);
  })
  .catch(function (error) {
      console.log(error);
      if(error){
        setIsError(true)
      }
  });
}
}

function cartError(){
  if(isError){
    return <p style={{direction:"rtl", color:"red", background:"white", borderRadius:"5px", padding:"5px 0"}}>لطفا برای اضافه کردن در سبد <Link to='/login'>وارد</Link> شوید.</p>
  } else if(succes && course.price !== null) {
    return <p style={{direction:"rtl", color:"white", background:"green", borderRadius:"5px", padding:"5px 2px"}}>با موفقیت به سبد خرید اضافه شد.</p>
  } else if(succes && course.price === null) {
    return <p style={{direction:"rtl", color:"white", background:"green", borderRadius:"5px", padding:"5px 2px"}}>با موفقیت به ایمیلتان فرستاده شد.</p>
  }
}

function submit(){
  axios.post('http://www.sararajabi.com/api/v1/courseComment/store', {
      comment: newComment,
      name: name,
      course_id: id,
  }, {
      headers: {
        'api_key': `${token}` 
      }
    }
  )
  .then(function (response) {
      if(response.statusText === "Created"){
          alert('کامنت شما با موفقیت ثبت شد.');
          setName('');
          setNewComment('');
      }
  })
  .catch(function (error) {
      console.log(error);
      alert('لطفا درگاه هارا درست وارد کنید');
  });
}

function handlePrice(course){
  if(course.price === null){
    return <SMLeft>رایگان!</SMLeft>
  } else {
    return <SMLeft>{course.price} تومان</SMLeft>
  }
}

function handleVideo(videos){
  if(videos != 0){
    return (
      <Videos>

      <div style={{width:"90%", display:"flex", flexDirection:"column", alignItems:"center", justifyContent:"center", flexWrap:"wrap"}}>
          {videos.map(({url}, i) => {
            return (
              <iframe className="media-vid" key={i} src={url} title="desc"></iframe>
            )
        })}
      </div>

        </Videos>
    )
  }
}
function handleImage(images){
  if(images != 0){
    return (
      <Videos>

      <div style={{width:"90%", display:"flex", flexDirection:"column", alignItems:"center", justifyContent:"center", flexWrap:"wrap"}}>
        {images.map(({url}, i) => {
          return (
            <img className="media-img" key={i} src={'http://sararajabi.com/' + url} alt="course"/>
          )
        })}
      </div>

        </Videos>)
  }
}

return course && desc && comments ? (
    <Container>
      <Particles params={backStyleTwo} style={gifStyleTwo}/>
      <Top></Top>

      <Middle>

        <Left>

          <Sidebar>

            <STop>

              <STH>خرید</STH>

              <STUL>

                <STLI>تحویل آنی</STLI>

                <STLI>تحویل از طریق ایمیل</STLI>
                
                <STLI>لینک اختصاصی شما</STLI>

              </STUL>

              {cartError()}

              <STHR/>

            </STop>

            <SMiddle>

              {handlePrice(course)}

              <SMRight>قیمت دوره</SMRight>

            </SMiddle>

            <SBottom>

              <Price onClick={handleAddCart(course)}>{handleStatus(course)}</Price>
              
            </SBottom>

          </Sidebar>

        </Left>

        <Center>

          <H>{course.name}</H>

          <HR/>

          <Category>{category.name} / {subCategoryName}</Category>

        </Center>
        
      </Middle>

      <STHR style={{border:"1px solid grey", width:"90%", margin:"50px auto"}} />

        {handleVideo(videos)}
        {handleImage(images)}
      
      <STHR style={{border:"1px solid grey", width:"90%", margin:"50px auto"}} />
      
      <Bottom>
        <BLeft>
        
        <SBC>
        <Sidebar>

            <STop>

              <STH>خرید</STH>

              <STUL>

                <STLI>تحویل آنی</STLI>

                <STLI>تحویل از طریق ایمیل</STLI>
                
                <STLI>لینک اختصاصی شما</STLI>

              </STUL>

              {cartError()}

              <STHR/>

            </STop>

            <SMiddle>

              {handlePrice(course)}

              <SMRight>قیمت دوره</SMRight>

            </SMiddle>

            <SBottom>

              <Price onClick={handleAddCart(course)}>{handleStatus(course)}</Price>
              
            </SBottom>

          </Sidebar>
          </SBC>

        </BLeft>
        <BRight>
        
        <div className="course-details-description-main" dangerouslySetInnerHTML={ {__html: desc.description} }/>
        </BRight>
      </Bottom>

      <STHR style={{border:"1px solid grey", width:"90%", margin:"50px auto"}} />

        <Videos active="true">
          <OthersContainer>
            <OTop>دیگر نوشته ها</OTop>
            <OBttom>
              <Link to="/courselist"><Box><BP>دوره ها</BP><BoxB course="true"></BoxB></Box></Link>
              <Link to="/articlelists"><Box><BP>مقاله ها</BP><BoxB article="true"></BoxB></Box></Link>
              <Link to="/consultante"><Box><BP>مشاوره</BP><BoxB></BoxB></Box></Link>
              <Link to="/whyme"><Box><BP>چرامن؟</BP><BoxB whyme="true"></BoxB></Box></Link>
            </OBttom>
          </OthersContainer>
        </Videos>

      <STHR style={{border:"1px solid grey", width:"90%", margin:"50px auto"}} />

      <CommentsH2>دیدگاه ها</CommentsH2>

      <Comments>

        <MakeNew>

          <MNTop>

            <MNLeft>

              <NameInput value={name} onChange={(item)=>{setName(item.target.value)}} required type="text" placeholder="نام شما"></NameInput>

            </MNLeft>

            <MNRight>

              <MNText>دیدگاه جدید</MNText>

            </MNRight>

          </MNTop>

          <MNBottom>

            <TextArea value={newComment} onChange={(item)=>{setNewComment(item.target.value)}} placeholder="دیدگاه شما" >

            </TextArea>

          </MNBottom>

          <MNSubBottom>

            <SubmitComments onFocus="this.value=''" onClick={()=>submit()}>ثبت دیدگاه</SubmitComments>

          </MNSubBottom>

        </MakeNew>

        {noComments()}

        <div style={comments ? {display:"unset"} : {display:"none"}}>
        {comments.map(({ comment, name }, i) => {
          return(
        <Comment key={i}>
          
          <UserTop>

            <Commenter><HiOutlineUserCircles/>{name}</Commenter>

          </UserTop>

          <UserComment>{comment}</UserComment>
        
        </Comment>);
})}
        </div>

      </Comments>

    </Container>
  ) : (
        <div style={{width:"100vw", height:"100vh", display:"flex", background: "#fff"}}>
            <Loader
            type="Oval"
            color="#F4DD4F"
            height={150}
            width={150}
            timeout={3000} //3 secs
            style={{margin: "auto"}}
            />
        </div>
  )
}

export default CourseDetails;