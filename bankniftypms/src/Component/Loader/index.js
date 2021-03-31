import React from "react"
import BounceLoader from "react-spinners/BounceLoader"
import { css } from "@emotion/react"

const override = css`
  display: block;
  margin: 0 auto;
  border-color: #49be00;
  top: 50%;
  left: 50%;
  position: fixed;
  color: darkred;
  margin-top: -32px;
  margin-left: -32px;
`

const Index = () => {
  return (
    <div className="loader">
      <BounceLoader css={override} color={"#49BE00"} loading={true} />
    </div>
  )
}

export default Index
