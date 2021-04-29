import React, { useEffect, useState } from 'react';
import {
    Container,
    Left,
    Right,
    Top,
    Bottom,
    Img,
    H1,
    TContainer,
    Block,
    SearchContainer,
    Search,
    Sticky,
    Submit,
    MainB,
    Searchs,
    NoResult,
    VscSearchStops,
    MBLeft,
    MBRight,
    MBImage,
    MBLTop,
    MBLBottom,
    MBLH1,
    MBLGoTo
} from './DetailsElements';
import courselogo from '../../images/courselogo.png';
import api from '../../api';
import { AiOutlineSearch } from 'react-icons/ai';
import Loader from 'react-loader-spinner';
import axios from 'axios';
import whymebg from '../../images/test2bg.jpeg';

const token = 'parsur';

const Article = () => {
    const [article, setArticle] = useState(null);
    const [search, setSearch] = useState("");
    const [noRes, setNoRes] = useState(null);

    useEffect(() => {
        api("api/v1/article/show")
            .then((data) => {
                setArticle([])
                setArticle(data.artciles);
            })
    }, []);

    function submit(){
        axios.post('http://sararajabi.com/api/v1/article/search', {
            search: search,
            column: 'title',
        }, {
            headers: {
              'api_key': `${token}` 
            }
          }
        )
        .then(function (response) {
            setArticle(response.data);
            if(response.data === ''){
                setNoRes(noResult);
                setArticle([]);
            } else {
                setNoRes(null);
            }
        })
        .catch(function (error) {
            console.log(error);
        });
    }

    

    function handleSearchChaneg(event){
        if (event.target.value === "") {
            api("api/v1/article/show")
            .then((data) => {
                setArticle(data.artciles);
            })
            setNoRes(null)
        } else {
            setSearch(event.target.value);
        }
    }

    const noResult = function () {
        return (
            <NoResult><VscSearchStops/>متاسفانه نتیجه ای پیدا نشد!</NoResult>
        );
    }

    function mediaCaller(media){
        if(media == 0){
            return whymebg
        } else {
            return "http://sararajabi.com/images/" + media[0].url
        }
    }

    return article ? (
        <Container>
            <Left>
                <Sticky>
                    <Top>
                        <TContainer>
                            <SearchContainer onSubmit={event => event.preventDefault()}>
                                <Searchs>
                                    <Search onChange={handleSearchChaneg} type="search" id="search" required="required" placeholder="سرچ کنید..." />
                                    <Submit onClick={()=>submit()} type="submit" value="جستجو"><AiOutlineSearch/></Submit>
                                </Searchs>
                            </SearchContainer>
                            <H1>مقاله ها</H1>
                        </TContainer>
                    </Top>
                    <Bottom>
                        <Img src={courselogo} alt="course logo" />
                    </Bottom>
                </Sticky>
            </Left>
            <Right>
                {noRes}
            {article.map(({ title, id, media }, i) => {
        return( <Block key={i}>

            <MainB to={`article/${id}`}>

                <MBRight><MBImage><img style={{width:"100%"}} src={mediaCaller(media)} alt="course"/></MBImage></MBRight>

                <MBLeft>

                    <MBLTop><MBLH1>{title}</MBLH1></MBLTop>
                    
                    <MBLBottom><MBLGoTo>آغاز مطالعه</MBLGoTo></MBLBottom>

                </MBLeft>

            </MainB>
            
            </Block> );
    })}
            </Right>
        </Container>
    ) : (
        <Container>
            <Left>
                <Sticky>
                    <Top>
                        <TContainer>
                            <SearchContainer onSubmit={event => event.preventDefault()}>
                                <Searchs>
                                    <Search onChange={handleSearchChaneg} type="search" id="search" required="required" placeholder="سرچ کنید..." />
                                    <Submit onClick={()=>submit()} type="submit" value="جستجو"><AiOutlineSearch/></Submit>
                                </Searchs>
                            </SearchContainer>
                            <H1>مقاله ها</H1>
                        </TContainer>
                    </Top>
                    <Bottom>
                        <Img src={courselogo} alt="course logo" />
                    </Bottom>
                </Sticky>
            </Left>
            <Right>
            <div style={{width:"100%", height:"50%", display:"flex"}}>
            <Loader
            type="Oval"
            color="#F4DD4F"
            height={150}
            width={150}
            timeout={3000} //3 secs
            style={{margin: "auto"}}
            />
        </div>
            </Right>
        </Container>
    );
}

export default Article;