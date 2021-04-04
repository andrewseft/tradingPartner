import React, { useEffect, lazy } from "react"
import { useSelector, useDispatch } from "react-redux"
import { loadHomePageData } from "../../actions/homePageActions"

const Home = lazy(() => import("../../Component/Page/home"))
const Offer = lazy(() => import("../../Component/Page/offer"))
const Features = lazy(() => import("../../Component/Page/features"))
const About = lazy(() => import("../../Component/Page/about"))
const Contact = lazy(() => import("../../Component/Page/contactUs"))

const Index = (props) => {
  const { title, location } = props
  const dispatch = useDispatch()
  const { homePageData, setting } = useSelector((state) => ({
    homePageData: state.homePageData,
    setting: state.setting,
  }))

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
      dispatch(loadHomePageData("index"))
    }
    fetchData()
  }, [dispatch])

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

export default Index
