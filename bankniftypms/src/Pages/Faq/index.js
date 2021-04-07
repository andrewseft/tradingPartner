import React, { useEffect, lazy } from "react"
import { useSelector, useDispatch } from "react-redux"
import { loadHomePageData } from "../../actions/homePageActions"
const Faq = lazy(() => import("../../Component/Page/faq"))
const Breadcrumb = lazy(() => import("../../Component/Breadcrumb"))

const Index = (props) => {
  const dispatch = useDispatch()
  const { homePageData } = useSelector((state) => ({
    homePageData: state.homePageData,
  }))

  useEffect(() => {
    const fetchData = () => {
      dispatch(loadHomePageData("index"))
    }
    fetchData()
  }, [dispatch])

  return (
    <div className="pt-5">
      <Breadcrumb {...props} />
      <Faq homePageData={homePageData} />
    </div>
  )
}

export default Index
