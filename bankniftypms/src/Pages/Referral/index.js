import React, { lazy, useState } from "react"
import { useSelector } from "react-redux"
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
import { Modal } from "react-bootstrap"
const Breadcrumb = lazy(() => import("../../Component/Breadcrumb"))
const Footer = lazy(() => import("../Partial/Footer"))

function ShareModal(props) {
  const { userInfo } = useSelector((state) => ({
    userInfo: state.userInfo,
  }))
  const message =
    "Hey friends, I am earning 5K daily from BANKNIFTY PMS without doing anything😍😄\n\nUse My Code " +
    userInfo.referral_code +
    " for Instant Approval and enjoy earning daily.😁😁\n\nDownload the BANKNIFTY PMS App Now👇👇\n\nhttps://bankpms.page.link/p1AeLCkPnxNJ5sfs9"
  return (
    <Modal
      {...props}
      size="lg"
      aria-labelledby="contained-modal-title-vcenter"
      centered
    >
      <Modal.Header closeButton>
        <Modal.Title id="contained-modal-title-vcenter">
          Invite Friends
        </Modal.Title>
      </Modal.Header>
      <Modal.Body>
        <div>
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
        </div>
      </Modal.Body>
    </Modal>
  )
}

const Index = (props) => {
  const { setting } = useSelector((state) => ({
    setting: state.setting,
  }))
  const [modalShow, setModalShow] = useState(false)
  const handleclickShare = (event) => {
    event.preventDefault()
    setModalShow(true)
  }
  return (
    <>
      <Breadcrumb {...props} />
      <div className="referral-banner">
        <div className="container pb-5">
          <div className="row">
            <div className="col-md-5 order-md-2">
              <div className="invited-img">
                <img src="./assets/img/invited.svg" alt="invited" />
              </div>
            </div>
            <div className="col-md-7 order-md-1">
              <div className="invite-friend-content">
                <h1>
                  Invite Friends.
                  <br />
                  Earn Commission Instant
                </h1>
                <p>
                  Earn up to
                  <span>
                    &nbsp;{setting.platform_commission}% commission
                  </span>{" "}
                  every time your friends make a trade on Banknifty PMS
                </p>

                <div className="login-and-invite-btns">
                  <a
                    className="invite-btn"
                    href="#!"
                    onClick={handleclickShare}
                  >
                    Invite Now
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div className="how-to-invite-friends">
        <div className="container">
          <div className="invite-friends-steps">
            <div className="row">
              <div className="col-md-12">
                <h3>How to invite your friends</h3>
              </div>
              <div className="col-md-4">
                <div className="referal-step">
                  <div className="refrel-step-img">
                    <img src="./assets/img/signup-img.png" alt="" />
                  </div>
                  <div className="refrel-step-content">
                    <h4>Get your link</h4>
                    <p>
                      Join Banknifty PMS and get your unique tracking link.
                      you'll earn for customers who sign up through this link
                    </p>
                    <div className="step-count">1</div>
                  </div>
                </div>
              </div>

              <div className="col-md-4">
                <div className="referal-step">
                  <div className="refrel-step-img">
                    <img src="./assets/img/sharelink.png" alt="" />
                  </div>
                  <div className="refrel-step-content">
                    <h4>Share your link</h4>
                    <p>
                      Share your links via Telegram, Twitter, Emails or anyway
                      you want. The more you promote. the move you earn.
                    </p>
                    <div className="step-count">2</div>
                  </div>
                </div>
              </div>

              <div className="col-md-4">
                <div className="referal-step">
                  <div className="refrel-step-img">
                    <img src="./assets/img/signup-img.png" alt="" />
                  </div>
                  <div className="refrel-step-content">
                    <h4>Get your link</h4>
                    <p>
                      You earn {setting.platform_commission}% commission on
                      every friends's trading fees! Even while you're asleep!
                    </p>
                    <div className="step-count">3</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div className="our-services-section">
        <div className="container">
          <div className="row">
            <div className="col-md-4">
              <div className="single-service">
                <div className="service-img">
                  <img src="./assets/img/commission.png" alt="" />
                </div>
                <h4>Earn {setting.platform_commission}% Commission</h4>
              </div>
            </div>
            <div className="col-md-4">
              <div className="single-service">
                <div className="service-img">
                  <img src="./assets/img/insta-payment.png" alt="" />
                </div>
                <h4>Instant Payment</h4>
              </div>
            </div>
            <div className="col-md-4">
              <div className="single-service">
                <div className="service-img">
                  <img src="./assets/img/unlimited-earning.png" alt="" />
                </div>
                <h4>Unlimited Earnings</h4>
              </div>
            </div>
            <div className="col-md-4">
              <div className="single-service">
                <div className="service-img">
                  <img src="./assets/img/tracking-reports.png" alt="" />
                </div>
                <h4>Easy Tracking & Reports</h4>
              </div>
            </div>
            <div className="col-md-4">
              <div className="single-service">
                <div className="service-img">
                  <img src="./assets/img/no-negative-charges.png" alt="" />
                </div>
                <h4>No Deduction on Negative Charges</h4>
              </div>
            </div>
            <div className="col-md-4">
              <div className="single-service">
                <div className="service-img">
                  <img src="./assets/img/cross-platform.png" alt="" />
                </div>
                <h4>Cross-Platform Support</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div className="best-referral-around">
        <div className="container">
          <div className="best-referral-around-content">
            <h2>
              <span>Best</span> Referral Around
            </h2>
            <p>
              your daily & monthly earnings sample, see how your earnings weill
              be count!
            </p>

            <div className="best-referral-counter">
              <div className="referral-heading">
                <i className="fa fa-star"></i>
                Referral
              </div>
              <div className="friends-profit">
                <h6>Freind's Profit</h6>
                <h2>
                  <i className="fa fa-inr"></i> 50,000
                </h2>
              </div>

              <div className="commission">
                <h6>Commission</h6>
                <h2>10,000</h2>
              </div>

              <div className="your-earnings">
                <h6>Your Earnings</h6>
                <h2>7,500</h2>
              </div>

              <div className="day">
                <h6>Day</h6>
                <h2>1</h2>
              </div>

              <div className="commission-slub">
                <h6>Commission Slub</h6>
                <h2>{setting.platform_commission}%</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div className="best-referral-around">
        <div className="container pt-5">
          <Footer />
        </div>
      </div>
      {modalShow && (
        <ShareModal show={modalShow} onHide={() => setModalShow(false)} />
      )}
    </>
  )
}

export default Index
