import React from "react"

const Offer = (props) => {
  const { homePageData } = props
  const prepareHtml = (description) => {
    if (description) {
      return { __html: description || "" }
    }
    return { __html: "" }
  }
  return (
    <>
      {homePageData.offer && (
        <section
          className="offer_sec"
          dangerouslySetInnerHTML={prepareHtml(homePageData.offer.description)}
        ></section>
      )}
    </>
  )
}

export default Offer
