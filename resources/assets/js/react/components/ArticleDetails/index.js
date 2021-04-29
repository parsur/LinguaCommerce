import React, { useEffect, useState } from 'react';
import{ useParams } from 'react-router-dom';
import {
  Container,
  Top,
  Middle,
  Center,
  HR,
  H,
  Category,
  STHR,
  Bottom,
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
  BRight
} from './ArticleDetailsElements';
import './articledetails.css';
import api from '../../api';
import '@brainhubeu/react-carousel/lib/style.css';
import axios from 'axios';
import Loader from 'react-loader-spinner';
import { Box, BoxB, BP, OBttom, OthersContainer, OTop } from '../CourseDetails/CourseDetailsElements';
import { Link } from 'react-router-dom';

const ArticleDetails = () => {
  let { id } = useParams();

  const [article, setArticle] = useState();
  const [desc, setDesc] = useState();
  const [comments, setComments] = useState();
  const [name, setName] = useState("");
  const [newComment, setNewComment] = useState("");
  const [subCategoryName, setSubCategoryName] = useState("");
  const [category, setCategory] = useState("");
  const [videos, setVideos] = useState([]);
  const [images, setImages] = useState([]);

useEffect(() => {
  api(`api/v1/article/details?id=${id}`)
      .then((data) => {
          setArticle(data.article);
          setDesc(data.article.description);
          setComments(data.article.comments);
          setCategory(data.article.category);
          setVideos(data.videos);
          setImages(data.images);
          if(data.article.sub_category === null){
            setSubCategoryName("");
          } else {
            setSubCategoryName(data.article.sub_category.name);
          }
      })
}, []);

function noComments(){
  if(comments == 0){
    return <NoComments>اولین کسی باشید که کامنت میگذارید</NoComments>
  }
}

const token = 'parsur';

function submit(){
  axios.post('http://www.sararajabi.com/api/v1/articleComment/store', {
      comment: newComment,
      name: name,
      article_id: id,
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
  });
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
            <div key={i}>
              <img className="media-img" src={'http://sararajabi.com/' + url} alt="course"/>
            </div>
          )
        })}
      </div>

        </Videos>)
  }
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

            {handleVideo(videos)}

            {handleImage(images)}
      
      <STHR style={{border:"1px solid grey", width:"90%", margin:"50px auto"}} />
      
      <Bottom>
        
        <BRight>
        
        <div className="course-details-description" dangerouslySetInnerHTML={ {__html: desc.description} }/>

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

            <SubmitComments onClick={()=>submit()}>ثبت دیدگاه</SubmitComments>

          </MNSubBottom>

        </MakeNew>

        {noComments()}

        <div style={comments ? {display:"unset"} : {display:"none"}}>
        {comments.map(({ comment, name }) => {
          return(
        <Comment>
          
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

export default ArticleDetails;