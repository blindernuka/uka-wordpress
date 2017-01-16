





var lengthUnit = 'vh';

$(document).ready(function(){

	var wordclouds = document.getElementsByClassName("widget_uka_wordcloud");
	var wordcloud;
	var height;
	var width;
	var words;
	var word;
	var placements;
	var randomLeft = Math.random();
	var randomTop = Math.random();
	var maxTries = 100;
	var i, j, k, l ,m;
	for (i = 0; i < wordclouds.length; i++){
		
		wordcloud = wordclouds[i];
				
		marginLeft = wordcloud.offsetWidth*+0.1;
		marginTop = wordcloud.offsetHeight*+0.1;
		width = wordcloud.offsetWidth*0.8;
		height = wordcloud.offsetHeight*0.8;

		if (width < height){
			lengthUnit = 'vw';
		}		

		
		words = wordcloud.children;
		
		placements = [];
		
		if (words.length > 0){
			word = words[0];
			updateSize(word);
			randomLeft = Math.floor(Math.random()*(width - word.offsetWidth));
			randomTop = Math.floor(Math.random()*(height - word.offsetHeight));
			
			word.style.left = (marginLeft+randomLeft)*100/wordcloud.offsetWidth + '%';
			word.style.top = (marginTop+randomTop)*100/wordcloud.offsetHeight + '%';
			
			placements.push(word);			
		}
		
		for (j = 1; j < words.length; j++){
				
			word = words[j];
			
			updateSize(word);
			
			randomLeft = Math.floor(Math.random()*(width - word.offsetWidth));
			randomTop = Math.floor(Math.random()*(height - word.offsetHeight));
			
			k = 0;
			while (k < maxTries){
				for (l = 0; l < placements.length; l++){
					
					word.style.left = (marginLeft+randomLeft)*100/wordcloud.offsetWidth + '%';
					word.style.top = (marginTop+randomTop)*100/wordcloud.offsetHeight + '%';
					
					if (isIntersecting(word, placements[l])){
						
						randomLeft = Math.floor(Math.random()*(width - word.offsetWidth));
						randomTop = Math.floor(Math.random()*(height - word.offsetHeight));
						
						word.style.left = (marginLeft+randomLeft)*100/wordcloud.offsetWidth + '%';
						word.style.top = (marginTop+randomTop)*100/wordcloud.offsetHeight + '%';
						
						l=-1;
						
						k++;
						
						if (k > maxTries){
							break;
						}
						
					}
					
				}
				break;
			}
			
			if (k < maxTries){
				word.style.left = (marginLeft+randomLeft)*100/wordcloud.offsetWidth + '%';
				word.style.top = (marginTop+randomTop)*100/wordcloud.offsetHeight + '%';
				placements.push(word);
			}
			else{
				word.style.display = 'none';
			}
			
		}
	}
	
});

function isIntersecting(A, B){
	if (A.offsetLeft > B.offsetLeft+B.offsetWidth ||
		A.offsetLeft+A.offsetWidth < B.offsetLeft ||
		A.offsetTop > B.offsetTop+B.offsetHeight ||
		A.offsetTop+A.offsetHeight < B.offsetTop){
		return false;
	}
	return true;
}



function updateSize(word){
	word.style.fontSize = word.getAttribute('weight') + lengthUnit;
	var wordcloudWidth = word.parentElement.offsetWidth*0.8;
	var wordcloudHeight = word.parentElement.offsetHeight*0.8;
	if (word.offsetWidth >= wordcloudWidth){
		word.setAttribute('weight', Math.floor(word.getAttribute('weight')*wordcloudWidth/(word.offsetWidth+1)));
		updateSize(word);
	}
	else if (word.offsetHeight > wordcloudHeight){
		word.setAttribute('weight', Math.floor(word.getAttribute('weight')*wordcloudHeight/(word.offsetHeight+1)));
		updateSize(word);
	}
}
















