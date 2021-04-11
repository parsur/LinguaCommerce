import { Link } from 'react-router-dom';
import styled from 'styled-components';
import LoginBg from '../../images/LoginBg.png';

export const Container = styled.div`
  width: 100%;
  min-height: 100px;
  display: flex;
  flex-direction: column;
  align-items: center;
`

  export const MainLoginPage = styled.div`
    width: 700px;
    min-height: 200px;
    background: #fff;
    display: flex;
    flex-direction: column;
    border-radius: 0 0 10px 10px;
  `

    export const Top = styled(Link)`
      height: 415px;
      width: 100%;
      background: url(${LoginBg});
      background-size: cover;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    `

      export const Logo = styled.img`
        width: auto;
        height: 90%;
      `

    export const Bottom = styled.div`
      width: 100%;
      min-height: 150px;
      padding: 0 30px;
      padding-bottom: 30px;
    `

      export const H2 = styled.h2`
        width: 100%;
        font-size: 40px;
        display: flex;
        flex-direction: column;
        align-items: center;
      `

      export const InputContainer = styled.div`
        width: 100%;
        height: 100px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
      `
      
        export const Input = styled.input`
          direction: rtl;
          padding: 0 5px;
          width: 90%;
          height: 45px;
          border-radius: ${props => props.top ? "8px 8px 0 0" : "0 0 8px 8px"};
          border: 1px solid #00000050;
          background: #fff;
          transition: 0.3s;

          &:hover{
          box-shadow: 1px 1px 3px grey;
          transition: 0.3s;
          }
        `

        export const Submit = styled.button`
          width: 50%;
          height: 40px;
          border-radius: 10px;
          border: none;
          font-size: 25px;
          background: #eee;
        `