module Handler.Home where

import Import
import Text.Blaze.Html (toHtml)

getHomeR :: Handler Html
getHomeR = defaultLayout $ do
    setTitleI ("Stravinsky" :: String)
    addStylesheet $ StaticR css_styles_css
    $(whamletFile "homepage.hamlet")

