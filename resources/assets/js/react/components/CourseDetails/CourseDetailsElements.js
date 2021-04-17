import styled from 'styled-components';
import detailstop from '../../images/detailstop.png';
import { HiOutlineUserCircle } from 'react-icons/hi';

export const Container = styled.div`
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 100%;
  background: #fff;
`

export const Top = styled.div`
  width: 100%;
  height: 180px;
  background: url(${detailstop});
  background-size: cover;
  z-index: 10;
`

export const Middle = styled.div`
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: wrap-reverse;
`

export const Left = styled.div`
  width: 340px;
  height: 600px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: flex-start;
  padding-top: 50px;
`

export const Center = styled.div`
  width: 650px;
  height: 500px;
  display: flex;
  flex-direction: column;
  align-items: center;
  z-index: 10;
`

export const Right = styled.div`
  width: 400px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
`

export const Sidebar = styled.div`
  width: 300px;
  height: 350px;
  background: #F4DD4F;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  border-radius: 10px;
  z-index: 10;
`

export const Figure = styled.div`
  width: 380px;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 50px 0;

  @media screen and (max-width:500px){
    width: 100%;
  }
`

export const Img = styled.img`
  width: 100%;
  height: auto;
`

export const FigCaption = styled.figcaption`
  width: 100%;
  direction: rtl;
  font-size: 30px;
  padding-right: 40px;
`

export const STop = styled.div`
  width: 100%;
  height: 60%;
  padding: 20px;
`

export const SMiddle = styled.div`
  width: 100%;
  height: 20%;
  display: flex;
`

export const SBottom = styled.div`
  width: 100%;
  height: 20%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
`

export const Price = styled.div`
  width: 90%;
  height: 60%;
  background: #fff;
  border-radius: 10px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  cursor: pointer;
`

export const HR = styled.hr`
  width: 70%;
  border: 1px solid grey;
  margin: 20px 0;
`

export const H = styled.h1`
  width: 75%;
  direction: rtl;
`

export const H3 = styled.h3`
  direction: rtl;
  margin-top: 10px;
  margin-right: 20px;
`

export const Category = styled.p`
  width: 65%;
  direction: rtl;
  color: darkcyan;
  cursor: pointer;
`

export const Description = styled.div`
  width: 75%;
  direction: rtl;
  margin: 20px 0;
  display: flex;
  flex-direction: column;
`

export const Ul = styled.ul`
  display: flex;
  flex-direction: column;
  margin-right: 50px;
`

export const Li = styled.li`
  margin-top: 10px;
`

export const Room = styled.div`
  width: 380px;
  min-height: 150px;
  background: #eee;
  margin: 10px 10px;
  border-radius: 15px;
  padding: 10px;

  @media screen and (max-width:500px){
    width: 100%;
  }
`

export const SMLeft = styled.div`
  width: 50%;
  height: 100%;
  direction: rtl;
  padding: 20px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: flex-end;
  font-size: 18px;
`

export const SMRight = styled.div`
  width: 50%;
  height: 100%;
  direction: rtl;
  padding: 20px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: flex-end;
  font-size: 20px;
  font-weight: bold;
`

export const STH = styled.h3`
  direction: rtl;
  margin-bottom: 15px;
  font-size: 25px;
`

export const STUL = styled.ul`
  display: flex;
  flex-direction: column;
  direction: rtl;
`

export const STLI = styled.li`
  margin-right: 25px;
  margin-bottom: 10px;
`

export const STHR = styled.hr`
  border: 1px solid #fff;
  margin-top: 20px;
`

export const Bottom = styled.div`
  width: 95%;
  height: auto;
  direction: ltr;
  padding: 0 35px;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;

  @media screen and (max-width: 500px){
    width: 100%;
    padding: 0 0;
  }
`

export const BLeft = styled.div`
  width: 30%;
  display: flex;
  flex-direction: column;
  align-items: center;
  min-width: 250px;
`

export const BRight = styled.div`
  width: 70%;
  direction: rtl;
  padding: 5px 20px;
  border-radius: 10px;
  min-height: 450px;
  min-width: 100px;
  display: flex;
  flex-direction: column;
  align-items: center;

  @media screen and (max-width:700px){
    width: 100%;
  }
`

export const SBC = styled.div`
  padding-top: 40px;
  position: sticky;
  position: -webkit-sticky;
  top: 0;
`

export const Comments = styled.div`
  width: 90%;
  border-radius: 10px;
  min-height: 100px;
  margin-bottom: 20px;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 20px 0;
`

export const MakeNew = styled.div`
  width: 60%;
  background: #eee;
  border-radius: 10px;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 10px 0;

  @media screen and (max-width:800px){
    width: 100%;
  }

  @media screen and (max-width:500px){
    width: 100%;
  }
`

export const MNTop = styled.div`
  width: 90%;
  height: 46%;
  display: flex;
`

export const MNBottom = styled.div`
  width: 90%;
  height: 46%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
`

export const MNLeft = styled.div`
  width: 50%;
  height: 60px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
`

export const MNRight = styled.div`
  width: 50%;
  height: 60px;
  display: flex;
  flex-direction: column;
  justify-content: center;
`

export const TextArea = styled.textarea`
  width: 90%;
  height: 100px;
  margin: 10px;
  resize: none;
  border-radius: 10px;
  direction: rtl;
  padding: 10px;
  border: 1px solid grey;
`

export const MNText = styled.div`
  direction: rtl;
  font-size: 30px;
  margin-right: 30%;

  @media screen and (max-width:500px){
    font-size: 20px;
  }
`

export const NameInput = styled.input`
  width: 80%;
  height: 40px;
  border-radius: 10px;
  border: 1px solid grey;
  direction: rtl;
  padding: 0 10px;
`

export const MNSubBottom = styled.div`
  width: 80%;
  height: 50px;
  display: flex;
  align-items: center;
  flex-direction: column;
  justify-content: center;
`

export const SubmitComments = styled.button`
  width: 45%;
  height: 90%;
  border-radius: 15px;
  border: none;
  background: #F4DD4F;
  font-size: 20px;
`

export const CommentsH2 = styled.h2`
  margin: 0 0 20px 0;
  width: 60%;
  direction: rtl;
  font-size: 40px;
  text-align: center;
`

export const Comment = styled.div`
  width: 700px;
  display: flex;
  flex-direction: column;
  align-items: center;
  background: #eee;
  border-radius: 10px;
  margin: 20px 0;
  padding: 10px 0;

  @media screen and (max-width:800px){
    width: 500px;
  }

  @media screen and (max-width:500px){
    width: 90vw;
  }
`

export const UserTop = styled.div`
  width: 80%;
  height: 80px;
  display: flex;
  flex-direction: column;
  justify-content: center;
`

export const UserComment = styled.div`
  width: 85%;
  min-height: 50px;
  resize: none;
  border-radius: 10px;
  direction: rtl;
  font-size: 22px;
  padding: 5px 10px;
  background: #fff;
  display: flex;
  flex-direction: column;
  justify-content: center;
`

export const Commenter = styled.h3`
  direction: rtl;
  display: flex;
  flex-direction: row;
  align-items: center;
  font-size: 30px;
  color: rgb(159, 161, 0);
`

export const HiOutlineUserCircles = styled(HiOutlineUserCircle)`
  color: black;
  font-size: 40px;
  margin-left: 10px;
`

export const Videos = styled.div`
  width: 100%;
  height: 400px;
  background-image: radial-gradient(circle, #eeeeee50 , #00000050);
  display: flex;
  justify-content: center;
  align-items: center;
`

export const Iframe = styled.iframe`
  width: unset;
`

export const NoComments = styled.div`
  direction: rtl;
  padding: 10px 30px;
  font-size: 30px;
  background: #eee;
  margin-top: 20px;
  border-radius: 10px;
`