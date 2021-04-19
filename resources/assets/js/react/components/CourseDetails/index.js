import React, { useEffect, useState } from 'react';
import{ useParams } from 'react-router-dom';
import {
  Container,
  Top,
  Middle,
  Left,
  Center,
  Right,
  Sidebar,
  Figure,
  STop,
  SMiddle,
  SBottom,
  Price,
  HR,
  H, H3,
  Category,
  Description,
  Ul, Li,
  Room,
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
  Videos, Iframe,
  NoComments
} from './CourseDetailsElements';
import test2bg from '../../images/test2bg.jpeg';
import ImageGallery from 'react-image-gallery';
import './coursedetails.css';
import api from '../../api';
import { CKEditor } from '@ckeditor/ckeditor5-react';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import Carousel, { Dots, slidesToShowPlugin} from '@brainhubeu/react-carousel';
import '@brainhubeu/react-carousel/lib/style.css';
import axios from 'axios';
import Loader from 'react-loader-spinner';
import Particles from 'react-particles-js';
import { backStyleTwo, gifStyleTwo } from '../../Data';

const images = [
  {
    original: 'https://images.pexels.com/photos/1563356/pexels-photo-1563356.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
    thumbnail: 'https://picsum.photos/id/1018/250/150/',
  },
  {
    original: 'https://picsum.photos/id/1015/1000/600/',
    thumbnail: 'https://picsum.photos/id/1015/250/150/',
  },
  {
    original: 'https://picsum.photos/id/1019/1000/600/',
    thumbnail: 'https://picsum.photos/id/1019/250/150/',
  },
];

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

useEffect(() => {
  api(`api/v1/course/details?id=${id}`)
      .then((data) => {
          console.log(data);
          setCourse(data.course);
          setDesc(data.course.description);
          setComments(data.course.comments);
          setCategory(data.course.category);
          if(data.course.sub_category === null){
            setSubCategoryName("");
          } else {
            setSubCategoryName(data.course.sub_category.name);
          }
      })
}, []);

function noComments(){
  if(comments == 0){
    return <NoComments>اولین کسی باشید که کامنت میگذارید!</NoComments>
  }
}

const token = 'parsur';

function addCart(){
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
      console.log(response);
      setSucces(true);
      window.location.reload(false);
  })
  .catch(function (error) {
      console.log(error);
      if(error){
        setIsError(true)
      }
  });
}

function cartError(){
  if(isError){
    return <p style={{direction:"rtl", color:"red", background:"white", borderRadius:"5px", padding:"5px 0"}}>لطفا برای اضافه کردن در سبد وارد شوید.</p>
  } else if(succes) {
    return <p style={{direction:"rtl", color:"white", background:"green", borderRadius:"5px", padding:"5px 2px"}}>با موفقیت به سبد خرید اضافه شد.</p>
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
      console.log(response);
      if(response.data.success === "دیدگاه مرتبط به دوره با موفقیت ثبت شد"){
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

              <Price onClick={addCart}>افزودن به سبد خرید</Price>
              
            </SBottom>

          </Sidebar>

        </Left>

        <Center>

          <H>{course.name}</H>

          <HR/>

          <Category>{category.name} / {subCategoryName}</Category>

          <Description>

            <Room><h2>توضیحات دوره پایینتر داده شده!</h2></Room>

          </Description>

        </Center>
        
      </Middle>

      <STHR style={{border:"1px solid grey", width:"90%", margin:"50px auto"}} />

        <Videos>

<div style={{width:"80%", display:"flex", flexDirection:"column", alignItems:"center", justifyContent:"center"}}>
        {/* <Carousel
    plugins={[
    'centered',
    'infinite',
    'arrows',
    {
      resolve: slidesToShowPlugin,
      options: {
       numberOfSlides: 2,
      },
    },
  ]}   
>
  <img src="https://images.pexels.com/photos/1563356/pexels-photo-1563356.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" />
  <img src="https://images.pexels.com/photos/1563356/pexels-photo-1563356.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" />
  <img src="https://images.pexels.com/photos/1563356/pexels-photo-1563356.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" />
</Carousel> */}
<Figure>

            {/* <ImageGallery showNav={false} showPlayButton={false} autoPlay={true} items={images} /> */}
            <h2 style={{direction:"rtl"}}>عکس یا فیلمی موجود نیست.</h2>

          </Figure>
</div>
          {/* {harchi.map(({ harchi }) => {
            return (
              <>
              </>
            );
          })} */}

        </Videos>
      
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

              <Price onClick={addCart}>افزودن به سبد خرید</Price>
              
            </SBottom>

          </Sidebar>
          </SBC>

        </BLeft>
        <BRight>
        
        <div className="course-details-description-main" dangerouslySetInnerHTML={ {__html: desc.description} }/>
        </BRight>
        {/* <CKEditor
                    editor={ ClassicEditor }
                    data={description.value}
                    config={ {
                      // Use the German language for this editor.
                      language: 'fa',
                      // ...
                  } }
              
                    onReady={ editor => {
                      editor.isReadOnly="true"
                    } }
                    onChange={ ( event, editor ) => {
                        const data = editor.getData();
                        console.log( { event, editor, data } );
                    } }
                    onBlur={ ( event, editor ) => {
                        console.log( 'Blur.', editor );
                    } }
                    onFocus={ ( event, editor ) => {
                        console.log( 'Focus.', editor );
                    } }
                />

        </BRight> */}
      </Bottom>

      <STHR style={{border:"1px solid grey", width:"90%", margin:"50px auto"}} />

      <CommentsH2>نظر ها</CommentsH2>

      <Comments>

        <MakeNew>

          <MNTop>

            <MNLeft>

              <NameInput value={name} onChange={(item)=>{setName(item.target.value)}} required type="text" placeholder="نام شما"></NameInput>

            </MNLeft>

            <MNRight>

              <MNText>کامنت نو</MNText>

            </MNRight>

          </MNTop>

          <MNBottom>

            <TextArea value={newComment} onChange={(item)=>{setNewComment(item.target.value)}} placeholder="کامنت شما" >

            </TextArea>

          </MNBottom>

          <MNSubBottom>

            <SubmitComments onFocus="this.value=''" onClick={()=>submit()}>ثبت کامنت</SubmitComments>

          </MNSubBottom>

        </MakeNew>

        {noComments()}

        <div style={comments ? {display:"unset"} : {display:"none"}}>
        {comments.map(({ comment }) => {
          return(
        <Comment>
          
          <UserTop>

            <Commenter><HiOutlineUserCircles/>کاربر</Commenter>

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
// dangerouslySetInnerHTML={ {__html: description.value} }