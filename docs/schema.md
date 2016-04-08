# Schema Design
### endofgame
---
- id (int, Primary)
- riotmatchid (int (big?))
- winner (int) // not sure how to do this given the api
- matchTime (Timestamp)
- createdAt (timestamp) 
- updatedAt (timestamp) // will allow us to note that a match has been pulled from API
---
Stores specific summoner information in a match
### summonermatch
- id (int, Primary)
- summonerId (int)
- matchId (int)
- runes (id)
- kills (int) 
- death (int) 
- assist (int) 
- farm (int) 
- gold (int) 
- matchItemListId (int, Foreign Key - summItemMatch.id)
- Any way to do what order skills are learned?
---
Storing item purchases efficiently for a summoner in a match
### summItemMatch
- id (int, Primary) 
- matchId (int, Foreign Key - endofgame.id) 
- summonerId (int)
- itemId (int)
- purchaseTime (timestamp)
---
Stores ward placement in a game as provided by Match Timeline api call
### wardPlacement
- id (int)
- matchId (int)
- team1Wards (int)
- team2Wards (int)
- x (float)
- y (float)


