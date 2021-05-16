import React, { lazy, useEffect, useState } from "react"
import { Row, Col, Card } from "react-bootstrap"
import { useSelector, useDispatch } from "react-redux"
import { getDashbord } from "../../actions/userActions"
import { Chart } from "react-google-charts"
import {
  FacebookIcon,
  FacebookShareButton,
  EmailShareButton,
  TwitterShareButton,
  WhatsappShareButton,
  EmailIcon,
  TwitterIcon,
  WhatsappIcon,
} from "react-share"
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
  const [referrlCount, SetReferrlCount] = useState([
    ["Not Interested", "Not Interested", "Lead In Process", "Leads Converted"],
    ["March", 0, 5, 0],
    ["April", 2, 24, 38],
    ["May", 0, 12, 18],
  ])
  const [payoutCount, SetPayoutCount] = useState([
    ["x", "Brokerage", "Fixed"],
    ["Jan", 30, 38],
    ["Feb", 10, 5],
    ["March", 23, 15],
  ])
  const [trade, SetTrade] = useState([
    ["Task", "Hours per Day"],
    ["Active", 11],
    ["InActive", 2],
  ])

  const message =
    "Hey friends, I am earning 5K daily from BANKNIFTY PMS without doing anything😍😄\n\nUse My Code " +
    userInfo.referral_code +
    " for Instant Approval and enjoy earning daily.😁😁\n\nDownload the BANKNIFTY PMS App Now👇👇\n\nhttps://bankpms.page.link/p1AeLCkPnxNJ5sfs9"

  useEffect(() => {
    if (userDashbord.referrlCount) {
      SetReferrlCount(userDashbord.referrlCount)
    }
    if (userDashbord.referrlPayout) {
      SetPayoutCount(userDashbord.referrlPayout)
    }
    if (userDashbord.tradeStatus) {
      SetTrade(userDashbord.tradeStatus)
    }
  }, [userDashbord])

  return (
    <>
      <Breadcrumb {...props} />
      <section className="dashboard_content_main dashbaord_home_dashboard dashbaord_home_dashboard_new">
        <Row className="m-0 p-0">
          <Col lg={12} className="mb-md-4">
            <Card>
              <Card.Body>
                <div className="heading_title">
                  <h1>
                    Hii, <span className="nickname">{userInfo.name}</span>
                  </h1>
                </div>
              </Card.Body>
            </Card>
          </Col>
          <Col lg={6} md={6} sm={6} xs={12}>
            <Card>
              <Card.Body>
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
                        <span className="ml-2">
                          {userDashbord.totalStartPms}
                        </span>
                      </div>

                      <div className="block">
                        <span>Stop PMS</span>
                        <span className="ml-2">
                          {userDashbord.totalStopPms}
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </Card.Body>
            </Card>
          </Col>
          <Col lg={3} md={3} sm={3} xs={12}>
            <Card>
              <Card.Body>
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

                    {/* <div className="wallet_content_margin w-100">
                  <div className="block">
                    <span>Margins used</span>
                    <span className="ml-2">0</span>
                  </div>

                  <div className="block">
                    <span>Opening balance</span>
                    <span className="ml-2">0</span>
                  </div>
                </div> */}
                  </div>
                </div>
              </Card.Body>
            </Card>
          </Col>
          <Col lg={3}>
            <Card>
              <Card.Body>
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
                  </div>
                </div>
              </Card.Body>
            </Card>
          </Col>
          <Col lg={6} className="mt-md-3">
            <Card>
              <Card.Header>Monthwise Lead referred And Convertes</Card.Header>
              <Card.Body>
                <Chart
                  width={"auto"}
                  height={"500px"}
                  chartType="ComboChart"
                  loader={<div>Loading Chart</div>}
                  data={referrlCount}
                  options={{
                    seriesType: "bars",
                    series: { 10: { type: "line" } },
                  }}
                />
              </Card.Body>
            </Card>
          </Col>
          <Col lg={6} className="mt-md-3">
            <Card>
              <Card.Header>Monthwise - Payout</Card.Header>
              <Card.Body>
                <Chart
                  width={"auto"}
                  height={"500px"}
                  chartType="LineChart"
                  loader={<div>Loading Chart</div>}
                  data={payoutCount}
                  options={{
                    series: {
                      1: { curveType: "function" },
                    },
                  }}
                  rootProps={{ "data-testid": "2" }}
                />
              </Card.Body>
            </Card>
          </Col>
          <Col lg={6} className="mt-md-3">
            <Card>
              <Card.Header>Trade Status</Card.Header>
              <Card.Body>
                <Chart
                  width={"auto"}
                  height={"400px"}
                  chartType="PieChart"
                  loader={<div>Loading Chart</div>}
                  data={trade}
                  options={{
                    is3D: true,
                  }}
                  rootProps={{ "data-testid": "2" }}
                />
              </Card.Body>
            </Card>
          </Col>
          <Col lg={6} className="mt-md-3">
            <Card.Header>Share the link on</Card.Header>
            <Card>
              <div className="w-100 float-left p-2 mt-3 border text-center">
                <ul className="w-100 float-left mt-2">
                  <FacebookShareButton url={message} className="p-2">
                    <FacebookIcon size={32} round={true} />
                  </FacebookShareButton>
                  <EmailShareButton url={message} className="p-2">
                    <EmailIcon size={32} round={true} />
                  </EmailShareButton>
                  <TwitterShareButton url={message} className="p-2">
                    <TwitterIcon size={32} round={true} />
                  </TwitterShareButton>
                  <WhatsappShareButton url={message} className="p-2">
                    <WhatsappIcon size={32} round={true} />
                  </WhatsappShareButton>
                </ul>
              </div>
            </Card>
          </Col>
        </Row>
      </section>
    </>
  )
}

export default Index
