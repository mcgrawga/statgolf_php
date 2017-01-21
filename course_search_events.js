<!--
var xmlHttp

function StateCourseSearch(TeeID)
{ 
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null)
	{
		alert ("Browser does not support HTTP Request");
	 	return;
	} 
	var url="courseserver.php";
	url=url+"?id="+ TeeID;
	//alert(url);
	xmlHttp.onreadystatechange=DisplayCourses;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);

}

function DisplayCourses()
{
	if (xmlHttp.readyState==4)
	{ 
		//alert("Back from Server");
		var xmlDoc=xmlHttp.responseXML.documentElement;
		var CourseArray = xmlDoc.getElementsByTagName("row");
		
		//
		//  ADD ALL THE TEES FOR THE SELECTED COURSE TO THE TEE DROP DOWN LIST
		//	
		//alert(CourseArray.length);
		var html = "";
		if (CourseArray.length > 0)
		{
			//alert("got here 1");
			html = "<br><br><table><tr><td>COURSE</td><td>CITY</td><td></td></tr>";
		}
		else
		{
			html = "<br><br>No Results Found.";
		}
			
		for (i = 0; i < CourseArray.length; i++)
		{
			var CourseIdentifier = "Course";
			CourseIdentifier += CourseArray[i].getElementsByTagName("course_id")[0].childNodes[0].nodeValue;
			html += "<tr>";
			html += "<td>";
			html +=  CourseArray[i].getElementsByTagName("name")[0].childNodes[0].nodeValue;
			html += "</td>";
			html += "<td>";
			if (CourseArray[i].getElementsByTagName("city")[0].childNodes.length > 0)
				html +=  CourseArray[i].getElementsByTagName("city")[0].childNodes[0].nodeValue;
			html += "</td>";
			html += "<td>";
			html += "<a href=\"#\" onclick=\"ShowCourseDetail(" + CourseIdentifier + ")\">+</a>"
			html += "</td>";
			html += "</tr>";
			html += "<span id=\"" + CourseIdentifier + "\"></span>";
		}
		//alert("got here 2");
		html += "</table>";
		document.getElementById("search_results").innerHTML = html;
	}
}

function ShowCourseDetail(SpanTagID)
{ 
	alert(SpanTagID);
}

function PopulateScorecardParValues() 
{ 
	if (xmlHttp.readyState==4)
	{ 
		//document.scorecard.ParHole9.value = xmlHttp.responseText;
		//document.scorecard.ParHole9.innerHTML = "6";
		
		
		var xmlDoc=xmlHttp.responseXML.documentElement;
		FrontNineTotal = parseInt(0);
		document.getElementById("ParHole1").innerHTML = xmlDoc.getElementsByTagName("par1")[0].childNodes[0].nodeValue;
		FrontNineTotal +=  parseInt(xmlDoc.getElementsByTagName("par1")[0].childNodes[0].nodeValue);
		document.getElementById("ParHole2").innerHTML = xmlDoc.getElementsByTagName("par2")[0].childNodes[0].nodeValue;
		FrontNineTotal +=  parseInt(xmlDoc.getElementsByTagName("par2")[0].childNodes[0].nodeValue);
		document.getElementById("ParHole3").innerHTML = xmlDoc.getElementsByTagName("par3")[0].childNodes[0].nodeValue;
		FrontNineTotal +=  parseInt(xmlDoc.getElementsByTagName("par3")[0].childNodes[0].nodeValue);
		document.getElementById("ParHole4").innerHTML = xmlDoc.getElementsByTagName("par4")[0].childNodes[0].nodeValue;
		FrontNineTotal +=  parseInt(xmlDoc.getElementsByTagName("par4")[0].childNodes[0].nodeValue);
		document.getElementById("ParHole5").innerHTML = xmlDoc.getElementsByTagName("par5")[0].childNodes[0].nodeValue;
		FrontNineTotal +=  parseInt(xmlDoc.getElementsByTagName("par5")[0].childNodes[0].nodeValue);
		document.getElementById("ParHole6").innerHTML = xmlDoc.getElementsByTagName("par6")[0].childNodes[0].nodeValue;
		FrontNineTotal +=  parseInt(xmlDoc.getElementsByTagName("par6")[0].childNodes[0].nodeValue);
		document.getElementById("ParHole7").innerHTML = xmlDoc.getElementsByTagName("par7")[0].childNodes[0].nodeValue;
		FrontNineTotal +=  parseInt(xmlDoc.getElementsByTagName("par7")[0].childNodes[0].nodeValue);
		document.getElementById("ParHole8").innerHTML = xmlDoc.getElementsByTagName("par8")[0].childNodes[0].nodeValue;
		FrontNineTotal +=  parseInt(xmlDoc.getElementsByTagName("par8")[0].childNodes[0].nodeValue);
		document.getElementById("ParHole9").innerHTML = xmlDoc.getElementsByTagName("par9")[0].childNodes[0].nodeValue;
		FrontNineTotal +=  parseInt(xmlDoc.getElementsByTagName("par9")[0].childNodes[0].nodeValue);
		document.getElementById("Front9Total").innerHTML = FrontNineTotal;
		
		var x=xmlDoc.getElementsByTagName("par10");
		//alert(x.length);
		if (x.length == 0)
		{
			//document.scorecard.Back9HTML.value = document.getElementById("secondnine").innerHTML;
			//alert(document.scorecard.Back9HTML.value);
			document.getElementById("secondnine").innerHTML = "";
		} 
		else
		{
			//alert(document.scorecard.Back9HTML.value);
			if ( document.scorecard.Back9HTML.value != "" )
			{
			//	alert("Got Here");
				//document.getElementById("secondnine").innerHTML = document.scorecard.Back9HTML.value;
			}
			//document.getElementById("secondnine").innerHTML = document.scorecard.Back9HTML.value;

			BackNineTotal = parseInt(0);
			document.getElementById("ParHole10").innerHTML = xmlDoc.getElementsByTagName("par10")[0].childNodes[0].nodeValue;
			BackNineTotal +=  parseInt(xmlDoc.getElementsByTagName("par10")[0].childNodes[0].nodeValue);
			document.getElementById("ParHole11").innerHTML = xmlDoc.getElementsByTagName("par11")[0].childNodes[0].nodeValue;
			BackNineTotal +=  parseInt(xmlDoc.getElementsByTagName("par11")[0].childNodes[0].nodeValue);
			document.getElementById("ParHole12").innerHTML = xmlDoc.getElementsByTagName("par12")[0].childNodes[0].nodeValue;
			BackNineTotal +=  parseInt(xmlDoc.getElementsByTagName("par12")[0].childNodes[0].nodeValue);
			document.getElementById("ParHole13").innerHTML = xmlDoc.getElementsByTagName("par13")[0].childNodes[0].nodeValue;
			BackNineTotal +=  parseInt(xmlDoc.getElementsByTagName("par13")[0].childNodes[0].nodeValue);
			document.getElementById("ParHole14").innerHTML = xmlDoc.getElementsByTagName("par14")[0].childNodes[0].nodeValue;
			BackNineTotal +=  parseInt(xmlDoc.getElementsByTagName("par14")[0].childNodes[0].nodeValue);
			document.getElementById("ParHole15").innerHTML = xmlDoc.getElementsByTagName("par15")[0].childNodes[0].nodeValue;
			BackNineTotal +=  parseInt(xmlDoc.getElementsByTagName("par15")[0].childNodes[0].nodeValue);
			document.getElementById("ParHole16").innerHTML = xmlDoc.getElementsByTagName("par16")[0].childNodes[0].nodeValue;
			BackNineTotal +=  parseInt(xmlDoc.getElementsByTagName("par16")[0].childNodes[0].nodeValue);
			document.getElementById("ParHole17").innerHTML = xmlDoc.getElementsByTagName("par17")[0].childNodes[0].nodeValue;
			BackNineTotal +=  parseInt(xmlDoc.getElementsByTagName("par17")[0].childNodes[0].nodeValue);
			document.getElementById("ParHole18").innerHTML = xmlDoc.getElementsByTagName("par18")[0].childNodes[0].nodeValue;
			BackNineTotal +=  parseInt(xmlDoc.getElementsByTagName("par18")[0].childNodes[0].nodeValue);
			document.getElementById("Back9Total").innerHTML = BackNineTotal;
		}
		
	} 
}

function PopulateCourseEditParValues() 
{ 
	if (xmlHttp.readyState==4)
	{ 
		
		var xmlDoc=xmlHttp.responseXML.documentElement;
		FrontNineTotal = parseInt(0);
		
		document.scorecard.SlopeRating.value = xmlDoc.getElementsByTagName("slope")[0].childNodes[0].nodeValue;
		document.scorecard.CourseRating.value = xmlDoc.getElementsByTagName("rating")[0].childNodes[0].nodeValue;
		
		document.scorecard.par1.value = xmlDoc.getElementsByTagName("par1")[0].childNodes[0].nodeValue;
		FrontNineTotal +=  parseInt(xmlDoc.getElementsByTagName("par1")[0].childNodes[0].nodeValue);
		document.scorecard.par2.value = xmlDoc.getElementsByTagName("par2")[0].childNodes[0].nodeValue;
		FrontNineTotal +=  parseInt(xmlDoc.getElementsByTagName("par2")[0].childNodes[0].nodeValue);
		document.scorecard.par3.value = xmlDoc.getElementsByTagName("par3")[0].childNodes[0].nodeValue;
		FrontNineTotal +=  parseInt(xmlDoc.getElementsByTagName("par3")[0].childNodes[0].nodeValue);
		document.scorecard.par4.value = xmlDoc.getElementsByTagName("par4")[0].childNodes[0].nodeValue;
		FrontNineTotal +=  parseInt(xmlDoc.getElementsByTagName("par4")[0].childNodes[0].nodeValue);
		document.scorecard.par5.value = xmlDoc.getElementsByTagName("par5")[0].childNodes[0].nodeValue;
		FrontNineTotal +=  parseInt(xmlDoc.getElementsByTagName("par5")[0].childNodes[0].nodeValue);
		document.scorecard.par6.value = xmlDoc.getElementsByTagName("par6")[0].childNodes[0].nodeValue;
		FrontNineTotal +=  parseInt(xmlDoc.getElementsByTagName("par6")[0].childNodes[0].nodeValue);
		document.scorecard.par7.value = xmlDoc.getElementsByTagName("par7")[0].childNodes[0].nodeValue;
		FrontNineTotal +=  parseInt(xmlDoc.getElementsByTagName("par7")[0].childNodes[0].nodeValue);
		document.scorecard.par8.value = xmlDoc.getElementsByTagName("par8")[0].childNodes[0].nodeValue;
		FrontNineTotal +=  parseInt(xmlDoc.getElementsByTagName("par8")[0].childNodes[0].nodeValue);
		document.scorecard.par9.value = xmlDoc.getElementsByTagName("par9")[0].childNodes[0].nodeValue;
		FrontNineTotal +=  parseInt(xmlDoc.getElementsByTagName("par9")[0].childNodes[0].nodeValue);
		document.scorecard.out.value = FrontNineTotal;
		
		BackNineTotal = parseInt(0);
		document.scorecard.par10.value = xmlDoc.getElementsByTagName("par10")[0].childNodes[0].nodeValue;
		BackNineTotal +=  parseInt(xmlDoc.getElementsByTagName("par10")[0].childNodes[0].nodeValue);
		document.scorecard.par11.value = xmlDoc.getElementsByTagName("par11")[0].childNodes[0].nodeValue;
		BackNineTotal +=  parseInt(xmlDoc.getElementsByTagName("par11")[0].childNodes[0].nodeValue);
		document.scorecard.par12.value = xmlDoc.getElementsByTagName("par12")[0].childNodes[0].nodeValue;
		BackNineTotal +=  parseInt(xmlDoc.getElementsByTagName("par12")[0].childNodes[0].nodeValue);
		document.scorecard.par13.value = xmlDoc.getElementsByTagName("par13")[0].childNodes[0].nodeValue;
		BackNineTotal +=  parseInt(xmlDoc.getElementsByTagName("par13")[0].childNodes[0].nodeValue);
		document.scorecard.par14.value = xmlDoc.getElementsByTagName("par14")[0].childNodes[0].nodeValue;
		BackNineTotal +=  parseInt(xmlDoc.getElementsByTagName("par14")[0].childNodes[0].nodeValue);
		document.scorecard.par15.value = xmlDoc.getElementsByTagName("par15")[0].childNodes[0].nodeValue;
		BackNineTotal +=  parseInt(xmlDoc.getElementsByTagName("par15")[0].childNodes[0].nodeValue);
		document.scorecard.par16.value = xmlDoc.getElementsByTagName("par16")[0].childNodes[0].nodeValue;
		BackNineTotal +=  parseInt(xmlDoc.getElementsByTagName("par16")[0].childNodes[0].nodeValue);
		document.scorecard.par17.value = xmlDoc.getElementsByTagName("par17")[0].childNodes[0].nodeValue;
		BackNineTotal +=  parseInt(xmlDoc.getElementsByTagName("par17")[0].childNodes[0].nodeValue);
		document.scorecard.par18.value = xmlDoc.getElementsByTagName("par18")[0].childNodes[0].nodeValue;
		BackNineTotal +=  parseInt(xmlDoc.getElementsByTagName("par18")[0].childNodes[0].nodeValue);
		document.scorecard.out.value = BackNineTotal;
		document.scorecard.total.value = BackNineTotal + FrontNineTotal;
	} 
}

function GetXmlHttpObject()
{
	var xmlHttp=null;
	
	try
	{
		// Firefox, Opera 8.0+, Safari
		xmlHttp=new XMLHttpRequest();
	}
	catch (e)
	{
		// Internet Explorer
		try
		{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e)
		{
			xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	return xmlHttp;
}







//-->