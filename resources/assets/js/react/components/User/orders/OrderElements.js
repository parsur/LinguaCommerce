import styled from 'styled-components';

export const Container = styled.div`
  width: 100%;
  height: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  background: #fff;
  border-radius: 20px 20px 0 0;
  border-top: 3px solid #F4DD4F;
  border-left: 3px solid #F4DD4F;
  border-right: 3px solid #F4DD4F;
  padding: 20px;
`

export const Block = styled.div`
  width: 100%;
  height: 100px;
  display: flex;
  justify-content: flex-start;
  padding: 10px;
  direction: rtl;

  @media screen and (max-width: 500px){
    /* flex-wrap: wrap; */
    justify-content: center;
    height: auto;
  }
`

export const Hr = styled.hr`
  width: 80%;
  margin-top: 20px;
  border: 2px solid #eee;

  @media screen and (max-width: 500px){
    display: none;
  }
`

export const BBlock = styled.div`
  height: 90%;
  direction: rtl;
  display: flex;
  align-items: flex-start;
  justify-content: center;
  align-items: center;
  margin-left: 8px;
  padding: 0 8px;
  border: 1px solid grey;
  border-radius: 5px;
  background: #fff;

  @media screen and (max-width: 500px){
    width: 40%;
    height: 80px;
    margin: 5px;
  }
`