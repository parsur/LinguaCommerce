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
  overflow: scroll;

  @media screen and (max-width: 500px){
    height: 69%
  }
`

export const Block = styled.div`
  width: 100%;
  display: flex;
  flex-direction: column;
  padding: 10px 10px;
  border-bottom: 2px solid #F4DD4F;
  align-items: flex-start;
`

export const BBlock = styled.div`
  height: 50px;
  width: 100%;
  direction: rtl;
  display: flex;
  align-items: flex-start;
  justify-content: flex-start;
  align-items: center;
  margin-left: 8px;
  padding: 0 8px;
  border-radius: 5px;
  background: #fff;
  overflow: scroll;
`

export const Bbutton = styled.button`
  width: 100px;
  height: 30px;
  border: none;
  outline: none;
  border-radius: 10px;
  background: gray;
  color: #fff;
`

export const ODBlock = styled.div`
  min-width: 100px;
  max-width: 800px;
  background: #F4DD4F;
  margin: 0 auto;
  border-radius: 15px;
  direction: rtl;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 20px 0;
`

export const NotPaied = styled.div`
  direction: rtl;
  background-color: red;
  min-width: 200px;
  max-width: 500px;
  height: 80px;
  border-radius: 15px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  margin: 0 auto;
  font-size: 1.5rem;
  padding: 0 10px;
`

export const Wrap = styled.div`
  width: 90%;
  height: 95%;
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: space-evenly;
  flex-wrap: wrap;
`

export const WrapText = styled.div`
  margin: 5px 10px;
`