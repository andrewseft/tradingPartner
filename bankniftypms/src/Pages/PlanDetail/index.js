import React, { useEffect, lazy, useState } from "react"
import { useSelector, useDispatch } from "react-redux"
import { getPlanDetailData, buyPlan } from "../../actions/planActions"
import { Tabs, Tab, Form, Row, Col, Table } from "react-bootstrap"
import { useParams, useHistory } from "react-router-dom"
import TextField from "@material-ui/core/TextField"
import { checkConform } from "../../utils/helpers"
import CanvasJSReact from "../../assets/canvasjs.react"
var CanvasJS = CanvasJSReact.CanvasJS
var CanvasJSChart = CanvasJSReact.CanvasJSChart
const Breadcrumb = lazy(() => import("../../Component/Breadcrumb"))

const Index = (props) => {
  const { slug } = useParams()
  const { push } = useHistory()
  const [amount, setAmount] = useState(0)
  const [fund, setFund] = useState(0)
  const [qty, setQty] = useState(0)
  const dispatch = useDispatch()
  const { planDetail } = useSelector((state) => ({
    planDetail: state.planDetail,
  }))

  const prepareHtml = (description) => {
    if (description) {
      return { __html: description || "" }
    }
    return { __html: "" }
  }

  useEffect(() => {
    const fetchData = () => {
      dispatch(getPlanDetailData(slug))
    }
    fetchData()
  }, [dispatch, slug])

  useEffect(() => {
    if (planDetail.id) {
      setFund(planDetail.walletAmount)
      setAmount(planDetail.amount)
      setQty(planDetail.walletAmount / planDetail.amount)
    }
  }, [planDetail])

  const fundChnage = (event) => {
    const val = event.target.value
    setQty(val / planDetail.amount)
    setFund(val)
  }

  const buyPlanClick = (event) => {
    event.preventDefault()
    var stripedHtml = planDetail.pmsPage.replace(/<[^>]+>/g, "")
    const afterCallback = () => {
      const request = {}
      request.plan_id = planDetail.id
      request.amount = fund
      request.type = 1
      dispatch(buyPlan(request, push))
    }
    checkConform(afterCallback, stripedHtml)
  }

  const options = {
    animationEnabled: true,

    toolTip: {
      shared: true,
    },
    data: [
      {
        type: "spline",
        name: "Profit",
        showInLegend: true,
        dataPoints: planDetail.profitChart,
      },
      {
        type: "spline",
        name: "P&L",
        showInLegend: true,
        dataPoints: planDetail.lossChart,
      },
    ],
  }

  return (
    <>
      <Breadcrumb {...props} />

      <div className="nse_main">
        <div className="nse_header">
          <h2>{planDetail.title}</h2>
        </div>

        <div className="">
          <Tabs defaultActiveKey="Regular" id="uncontrolled-tab-example">
            <Tab eventKey="Regular" title="Regular">
              <div className="tab_main p-3">
                <Form>
                  <Row>
                    <Col lg={3} md={3} sm={4}>
                      <div className="d-flex align-items-center bank_title">
                        {planDetail.tag &&
                          planDetail.tag.map((tag, key) => (
                            <span key={key}>{tag.title}</span>
                          ))}
                        {planDetail.category &&
                          planDetail.category.map((category, key) => (
                            <span key={key}>{category.title}</span>
                          ))}
                      </div>
                    </Col>
                    <Col lg={3} md={3} sm={4}>
                      <span className="mr-3">{planDetail.pl_percentage}</span>
                      <span>
                        {planDetail.currentAmount}({planDetail.pl_amount})
                      </span>
                    </Col>
                  </Row>
                  <Row className="pt-5">
                    <Col lg={3} md={3} sm={4}>
                      <div>
                        {planDetail.walletAmount && (
                          <Form.Group controlId="formBasicEmail">
                            <TextField
                              type="number"
                              variant="outlined"
                              id="outlined-email"
                              label="Allocated Fund"
                              className="w-100"
                              name="fund"
                              defaultValue={
                                planDetail.walletAmount
                                  ? planDetail.walletAmount
                                  : fund
                              }
                              inputProps={{ min: 0 }}
                              onChange={(e) => fundChnage(e)}
                            />
                          </Form.Group>
                        )}
                      </div>
                    </Col>
                    <Col lg={2} md={2} sm={4}>
                      <div>
                        <Form.Group controlId="formBasicEmail">
                          <TextField
                            variant="outlined"
                            id="outlined-email"
                            label="Quantify"
                            className="w-100"
                            name="qty"
                            InputProps={{
                              readOnly: true,
                            }}
                            value={qty}
                          />
                        </Form.Group>
                      </div>
                    </Col>
                    <Col lg={2} md={2} sm={4}>
                      <div>
                        <Form.Group controlId="formBasicEmail">
                          <TextField
                            variant="outlined"
                            id="outlined-email"
                            label="Price"
                            className="w-100"
                            name="price"
                            InputProps={{
                              readOnly: true,
                            }}
                            value={amount}
                          />
                        </Form.Group>
                      </div>
                    </Col>
                  </Row>
                </Form>
                {qty > 0 && (
                  <div className="nse_footer">
                    <a
                      href="#!"
                      className="btn buy"
                      onClick={(e) => buyPlanClick(e)}
                    >
                      Buy
                    </a>
                  </div>
                )}
              </div>
            </Tab>
            <Tab eventKey="Tab1" title="Features">
              <div className="tab_main p-3">
                <div
                  dangerouslySetInnerHTML={prepareHtml(planDetail.description)}
                ></div>
              </div>
            </Tab>
            <Tab eventKey="Tab2" title="Statement">
              <div className="tab_main p-3">
                <Table striped bordered hover>
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Invested</th>
                      <th>P&L</th>
                      <th>%Chg</th>
                    </tr>
                  </thead>
                  <tbody>
                    {planDetail.statements &&
                      planDetail.statements.map((item, key) => (
                        <tr
                          key={key}
                          className={
                            item.color ? "text-success" : "text-danger"
                          }
                        >
                          <td
                            className={
                              item.color ? "text-success" : "text-danger"
                            }
                          >
                            {item.date}
                          </td>
                          <td>{item.capital}</td>
                          <td>{item.pl}</td>
                          <td>{item.chg}</td>
                        </tr>
                      ))}
                  </tbody>
                </Table>
              </div>
            </Tab>
            <Tab eventKey="Tab3" title="Chart">
              <div className="tab_main p-3 w-100">
                <CanvasJSChart options={options} />
              </div>
            </Tab>
          </Tabs>
        </div>
      </div>
    </>
  )
}

export default Index
