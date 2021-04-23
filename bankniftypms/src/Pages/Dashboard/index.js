import React, { lazy, useEffect } from "react"
import { Row, Col } from "react-bootstrap"
import { useSelector, useDispatch } from "react-redux"
import { getDashbord } from "../../actions/userActions"
const Breadcrumb = lazy(() => import("../../Component/Breadcrumb"))

const Index = (props) => {
  const dispatch = useDispatch()
  const { userInfo, userDashbord } = useSelector((state) => ({
    userInfo: state.userInfo,
    userDashbord: state.userDashbord,
  }))
  useEffect(() => {
    const fetchData = () => {
      dispatch(getDashbord())
    }
    fetchData()
  }, [dispatch])

  return (
    <>
      <Breadcrumb {...props} />
      <section className="dashboard_content_main dashbaord_home_dashboard">
        <Row className="m-0 p-0">
          <Col lg={12} className="mb-md-4">
            <div className="heading_title">
              <h1>
                Hii, <span className="nickname">{userInfo.name}</span>
              </h1>
            </div>
            <hr></hr>
          </Col>

          <Col lg={6} md={6} sm={6} xs={12}>
            <div className="dashbaord_wallet_inner">
              <div className="secondary-title">
                <span className="">
                  <i className="fas fa-wallet"></i>
                </span>
                <span className="ml-2">Wallet</span>
              </div>

              <div className="d-flex justify-content-between mt-2 mt-md-4">
                <div className="wallet_content_main w-100">
                  <div className="wallet_counter">
                    <span>{userDashbord.walletAmount}</span>
                  </div>

                  <div className="label_wallet">
                    <span>Funds</span>
                  </div>
                </div>

                <div className="wallet_content_margin w-100">
                  <div className="block">
                    <span>Running PMS</span>
                    <span className="ml-2">{userDashbord.totalStartPms}</span>
                  </div>

                  <div className="block">
                    <span>Stop PMS</span>
                    <span className="ml-2">{userDashbord.totalStopPms}</span>
                  </div>
                </div>
              </div>
            </div>
          </Col>

          <Col lg={5} md={6} sm={6} xs={12}>
            <div className="dashbaord_wallet_inner">
              <div className="secondary-title">
                <span className="">
                  <i className="fa fa-clock" aria-hidden="true"></i>
                </span>
                <span className="ml-2">Charges</span>
              </div>

              <div className="d-flex justify-content-between mt-2 mt-md-4">
                <div className="wallet_content_main w-100">
                  <div className="wallet_counter">
                    <span>{userDashbord.charges}</span>
                  </div>

                  <div className="label_wallet">
                    <span>Total Charges</span>
                  </div>
                </div>

                <div className="wallet_content_margin w-100">
                  <div className="block">
                    <span>Margins used</span>
                    <span className="ml-2">0</span>
                  </div>

                  <div className="block">
                    <span>Opening balance</span>
                    <span className="ml-2">0</span>
                  </div>
                </div>
              </div>
            </div>
          </Col>

          <Col className="spacer mt-md-4" lg={12}>
            <hr></hr>
          </Col>
          <Col lg={8} className="mt-md-5">
            <div className="dashbaord_wallet_inner">
              <div className="secondary-title">
                <span className="">
                  <i className="fa fa-briefcase" aria-hidden="true"></i>
                </span>
                <span className="ml-2">Holdings</span>
                <span>({userDashbord.totalHolding})</span>
              </div>

              <div className="d-flex justify-content-between mt-2 mt-md-4">
                <div className="wallet_content_main w-100">
                  <div className="wallet_counter d-flex align-items-baseline">
                    <span className="text-success">{userDashbord.PL}</span>
                    <p className="text-success ml-2">{userDashbord.chg}</p>
                  </div>

                  <div className="label_wallet">
                    <span>P&L</span>
                  </div>
                </div>

                <div className="wallet_content_margin w-100">
                  <div className="block">
                    <span>Current value</span>
                    <span className="ml-2">{userDashbord.currentInvested}</span>
                  </div>

                  <div className="block">
                    <span>Investment</span>
                    <span className="ml-2">{userDashbord.totalInvested}</span>
                  </div>
                </div>
              </div>
            </div>
          </Col>
        </Row>
      </section>
    </>
  )
}

export default Index
