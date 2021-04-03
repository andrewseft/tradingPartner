import React, { useEffect } from "react"
import { connect } from "react-redux"
import { bindActionCreators } from "redux"
import * as homePageActions from "../../actions/homePageActions"
import Home from "../../Component/Page/home"
import Offer from "../../Component/Page/offer"
import Features from "../../Component/Page/features"
import About from "../../Component/Page/about"
import Contact from "../../Component/Page/contactUs"

const Index = (props) => {
  const { title, location, actions, homePageData, setting } = props

  useEffect(() => {
    document.title = title
    var id = location.pathname.replace("/", "")
    var position = document.getElementById(id.trim())
    if (position) {
      position.scrollIntoView({ behavior: "smooth" })
    }
  }, [title, location])

  useEffect(() => {
    const fetchData = () => {
      actions.loadHomePageData("index")
    }
    fetchData()
  }, [actions])

  return (
    <>
      <Home setting={setting} />
      <Offer homePageData={homePageData} />
      <About homePageData={homePageData} />
      <Features homePageData={homePageData} />
      <Contact setting={setting} />
    </>
  )
}

function mapStateToProps(state) {
  return {
    homePageData: state.homePageData,
    setting: state.setting,
  }
}

function mapDispatchToProps(dispatch) {
  return {
    actions: bindActionCreators(Object.assign(homePageActions), dispatch),
  }
}

export default connect(mapStateToProps, mapDispatchToProps)(Index)
