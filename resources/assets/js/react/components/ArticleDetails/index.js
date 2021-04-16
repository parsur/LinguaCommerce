import React, { useEffect, useState } from 'react';
import{ useParams } from 'react-router-dom';
import {
  Container,
  Top,
  Middle,
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
  NoComments,
  BRight
} from './ArticleDetailsElements';
import test2bg from '../../images/test2bg.jpeg';
import ImageGallery from 'react-image-gallery';
import './articledetails.css';
import api from '../../api';
import { CKEditor } from '@ckeditor/ckeditor5-react';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import Carousel, { Dots, slidesToShowPlugin} from '@brainhubeu/react-carousel';
import '@brainhubeu/react-carousel/lib/style.css';
import axios from 'axios';
import Loader from 'react-loader-spinner';

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

const ArticleDetails = () => {
  let { id } = useParams();

  const [article, setArticle] = useState();
  const [desc, setDesc] = useState();
  const [comments, setComments] = useState();
  const [name, setName] = useState("");
  const [NewComment, setNewComment] = useState("");
  const [subCategoryName, setSubCategoryName] = useState("");
  const [category, setCategory] = useState("");

useEffect(() => {
  api(`api/v1/article/details?id=${id}`)
      .then((data) => {
          console.log(data);
          setArticle(data.article);
          setDesc(data.article.description);
          setComments(data.article.comments);
          setCategory(data.article.category);
          if(data.article.sub_category === null){
            setSubCategoryName("");
          } else {
            setSubCategoryName(data.article.sub_category.name);
          }
      })
}, []);

function noComments(){
  if(comments == 0){
    return <NoComments>اولین کسی باشید که کامنت میگذارید!</NoComments>
  }
}

const token = 'parsur';

function submit(){
  console.log(id);
  axios.post('http://www.sararajabi.com/api/v1/articleComment/store', {
      comment: NewComment,
      name: name,
      article_id: id,
  }, {
      headers: {
        'api_key': `${token}` 
      }
    }
  )
  .then(function (response) {
      console.log(response);
  })
  .catch(function (error) {
      console.log(error);
  });
}

  return article && desc && comments ? (
    <Container>

      <Top></Top>

      <Middle>

        <Center>

          <H>{article.title}</H>

          <HR/>

          <Category>{category.name} / {subCategoryName}</Category>

        </Center>
        
      </Middle>

        <Videos>

<div style={{width:"80%", background:"#00000050"}}>
        <Carousel
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
</Carousel>
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
        
        {/* <div className="course-details-description" dangerouslySetInnerHTML={ {__html: desc.description} }/> */}
        <BRight>
        
        <CKEditor
                    editor={ ClassicEditor }
                    data={desc.description}
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

        </BRight>
      </Bottom>

      <STHR style={{border:"1px solid grey", width:"90%", margin:"50px auto"}} />

      <CommentsH2>نظر ها</CommentsH2>

      <Comments>

        <MakeNew>

          <MNTop>

            <MNLeft>

              <NameInput onChange={(item)=>{setName(item.target.value)}} required type="text" placeholder="نام شما"></NameInput>

            </MNLeft>

            <MNRight>

              <MNText>کامنت نو</MNText>

            </MNRight>

          </MNTop>

          <MNBottom>

            <TextArea onChange={(item)=>{setNewComment(item.target.value)}} placeholder="کامنت شما" >

            </TextArea>

          </MNBottom>

          <MNSubBottom>

            <SubmitComments onClick={()=>submit()}>ثبت کامنت</SubmitComments>

          </MNSubBottom>

        </MakeNew>

        {noComments()}

        <div style={comments ? {display:"unset"} : {display:"none"}}>
        {comments.map(({ comment }) => {
          return(
        <Comment>
          
          <UserTop>

            <Commenter><HiOutlineUserCircles/>جوزف دو</Commenter>

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

export default ArticleDetails;
// dangerouslySetInnerHTML={ {__html: description.value} }