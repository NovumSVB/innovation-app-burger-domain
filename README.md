# Mock Burger simulatie, 
<p align="center"><img src="https://gitlab.com/NovumGit/innovation-app-core/-/raw/master/assets/novum.png"  alt="Novum logo"/></p>

## Summary
This package contains domain files for a mock api of the Burger simulatie. Together with their corresponding site files 
they make up a mock API  + admin panel that represents the Burger simulatie in a whole ecosystem of API's and 
their corresponding admin panels.

## Background
From an article of the Dutch Ombudsmen about the government and its relation with civilians one important conclusion was 
drawn. In summary the conclusion is that civilians would like to have a single point of contact when dealing with the 
government. When realizing such a scenario, several questions or problems arise such as how to deal with privacy, how 
could this be implemented, how to manage information streams, who will get access to what etc.

This was one of the many reasons to initiate the "een overheid" (one government) project. The goal of this project was 
to realize the scenario above for a single regulation that involved a lot of government agencies and thereby 
bureaucracy, long timeframes, privacy matters etc.

This project was  initiated by
[Novum](https://novum.nu/), the Innovation lab of the dutch social services called [Sociale verzekeringsbank](https://svb.nl).

## Concepts
The project was inspired on the [architectual principles](https://www.gemmaonline.nl/images/gemmaonline/6/67/20190328_-_Gemeentelijk_Gegevenslandschap_-_Informatiearchitectuurprincipes.pdf)
of [common ground](https://commonground.nl/) which are in summary: Component based, trusted, open, 
data at the source / keep data on a single location, ownership of your own data, standards based. Intra government 
communication employs [NlX](https://nlx.io/) as a secure and decentralized communication layer.

## Other systems
The system is made up of a bunch of rest api's that all follow a similar pattern. Each datamodel is by no means a 
reflection of the reality which would be way to complex and not relevant for this proof of concept. The main idea is
that all technologies that make up the chain would be included in order to get hands on experience and learn from the
problems that we encounter on the way. 


|#    | Government agency |   |   |
|-----|-------------------|---|---|
|1|CBS|[documentation](https://api.cbs.demo.novum.nu)|[demo api](=https://api.cbs.demo.novum.nu)|
|2|Basisregistratie inkomen|[documentation](https://api.belastingdienst.demo.novum.nu)|[demo api](=https://api.belastingdienst.demo.novum.nu)|
|3|Digid|[documentation](https://api.digid.demo.novum.nu)|[demo api](=https://api.digid.demo.novum.nu)|
|4|Sociale verzekeringsbank|[documentation](https://api.svb.demo.novum.nu)|[demo api](=https://api.svb.demo.novum.nu)|
|5|UWV|[documentation](https://api.uwv.demo.novum.nu)|[demo api](=https://api.uwv.demo.novum.nu)|
|6|Basisregistratie persoonsgegevens|[documentation](https://api.gemeente.demo.novum.nu)|[demo api](=https://api.gemeente.demo.novum.nu)|
|7|Centraal justitieel incassobureau|[documentation](https://api.cjib.demo.novum.nu)|[demo api](=https://api.cjib.demo.novum.nu)|
|8|Een overheid|[documentation](https://api.overheid.demo.novum.nu)|[demo api](=https://api.overheid.demo.novum.nu)|
|9|Burger simulatie|[documentation](https://api.burger.demo.novum.nu)|[demo api](=https://api.burger.demo.novum.nu)|
|10|Justitie en veiligheid|[documentation](https://api.justitie.demo.novum.nu)|[demo api](=https://api.justitie.demo.novum.nu)|

## Try / have a look
If you wish to have a look at the system, the API's are reachable trough the public internet or via 
[NlX](https://directory.demo.nlx.io/). The respective admin panels are also available on the public internet. Please 
contact us if you would like to peek around. 

## Installation
If you wish to do your own installation, the best starting point would be to install the 
[demo system](https://docs.demo.novum.nu/demo-system). 

## Contribute
It would be great if we could make these systems more realistic in terms of data and datamodel or extend it's 
functionality. Please feel free to submit a pull request or contact us whenever you feel like doing a contribution in 
any way.
    
## More info
Please refer to the [documentation](https://docs.demo.novum.nu) if you need more information or are interested in doing a custom installation.
