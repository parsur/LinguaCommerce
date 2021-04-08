import React, { useEffect, useState } from 'react';
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
  SBC
} from './ArticleDetailsElements';
import test2bg from '../../images/test2bg.jpeg';
import ImageGallery from 'react-image-gallery';
import './articledetails.css';
import api from '../../api';
import { CKEditor } from '@ckeditor/ckeditor5-react';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

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

  const [course, setCourse] = useState([]);
  const [intro, setIntro] = useState([]);
  const [description, setDescription] = useState([]);

    useEffect(() => {
        api("api/course/details")
            .then(({ course }) => {
                setCourse(course);
                setIntro(course.description);
            })
    }, []);

    useEffect(() => {
      api("api/whyMe")
          .then((data) => {
              setDescription(data.whyMe);
          })
  }, []);

  return (
    <Container>

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

              <STHR/>

            </STop>

            <SMiddle>

              <SMLeft>{course.price} تومان</SMLeft>

              <SMRight>قیمت دوره</SMRight>

            </SMiddle>

            <SBottom>

              <Price>افزودن به سبد خرید</Price>
              
            </SBottom>

          </Sidebar>

        </Left>

        <Center>

          <H>{course.name}</H>

          <HR/>

          <Category>دوره ها / فن بیان</Category>

          <Description>

            <Room dangerouslySetInnerHTML={{ __html: intro.description }}></Room>

            <H3>کسب های این دوره</H3>

            <Ul>
              
              <Li>جالب میشوید</Li>

              <Li>جالب تر میشوید</Li>

            </Ul>

          </Description>

        </Center>

        <Right>

          <Figure>

            <ImageGallery showNav={false} showPlayButton={false} autoPlay={true} items={images} />

          </Figure>

        </Right>
        
      </Middle>

      <STHR style={{border:"1px solid grey", width:"90%", margin:"20px auto"}} />
      
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

              <STHR/>

            </STop>

            <SMiddle>

              <SMLeft>{course.price} تومان</SMLeft>

              <SMRight>قیمت دوره</SMRight>

            </SMiddle>

            <SBottom>

              <Price>افزودن به سبد خرید</Price>
              
            </SBottom>

          </Sidebar>
          </SBC>

        </BLeft>
        <BRight>
        
        <CKEditor
                    editor={ ClassicEditor }
                    data={description.value}
                    config={ {
                      // Use the German language for this editor.
                      removePlugins: ['Image', 'ImageCaption', 'ImageStyle', 'ImageToolbar', 'ImageUpload', 'MediaEmbed'],
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

    </Container>
  )
}

export default ArticleDetails;
// dangerouslySetInnerHTML={ {__html: description.value} }